<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use App\Models\Platform;
use App\Models\Section;
use Livewire\Component;

class CourseLesson extends Component
{

    public $section, $lesson, $platforms, $name, $platform_id=1, $url;


    protected $rules = [
        'lesson.name' => 'required',
        'lesson.platform_id' => 'required',
        'lesson.url' => ['required', 'regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x']
    ];

    public function mount(Section $section)
    {
        $this->section = $section;
        $this->lesson = new Lesson();
        $this->platforms = Platform::all();
    }

    public function render()
    {
        return view('livewire.instructor.course-lesson');
    }

    public function store()
    {
        $rules = [
            'name' => 'required',
            'platform_id' => 'required',
            'url' => ['required', 'regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x']
        ];

        if($this->platform_id == 2){
            $rules['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }

        $this->validate($rules);

        //creamos un nuevo registro
        Lesson::create([
            'name' => $this->name,
            'platform_id' => $this->platform_id,
            'url' => $this->url,
            'section_id' => $this->section->id
        ]);
        
        //formateamos los campos
        $this->reset('name', 'platform_id', 'url');

        //actualizamos la informacion de la seccion
        $this->section = Section::find($this->section->id);

    }

    public function edit(Lesson $lesson)
    {
        $this->resetValidation();
        $this->lesson = $lesson;   
    }

    public function update()
    { 
        if($this->lesson->platform_id == 2){
            $this->rules['lesson.url'] =  ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }
        $this->validate();

        $this->lesson->save();
        $this->lesson = new Lesson();

        $this->section = Section::find($this->section->id);
    }

    public function cancel()
    {
        $this->lesson = new Lesson();
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        $this->section = Section::find($this->section->id);
    }
}