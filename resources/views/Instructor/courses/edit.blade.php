<x-instructor-layout :course="$course">


    {{-- FORMULARIO --}}
    <h1 class="text-2xl font-bold">INFORMACIÓN DEL CURSO</h1>
    <hr class="mt-2 mb-6">

    {!! Form::model($course, ['route' => ['instructor.courses.update', $course], 'method' => 'put', 'files' => true]) !!}

        @include('instructor.courses.partials.form')    

        <div class="flex justify-end">
            {!! Form::submit('Actualizar información', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    <x-slot name="js">

        <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>

        <script src="{{asset('js/instructor/course/form.js')}}"> </script>
    </x-slot>

</x-instructor-layout>