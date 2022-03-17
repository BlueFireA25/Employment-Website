@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.min.css" integrity="sha512-qkeymXyips4Xo5rbFhX+IDuWMDEmSn7Qo7KpPMmZ1BmuIA95IPVYsVZNn8n4NH/N30EY7PUZS3gTeTPoAGo1mA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('navigation')
    @include('ui.adminav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">New Vacant</h1>

    <form class="max-w-lg mx-auto my-10" action="{{ route('vacancies.store') }}" method="POST">

        @csrf 

        <div class="mb-5">
            <label for="title" class="block text-gray-700 text-sm mb-2">Vacant Title: </label>
            <input 
                id="title" 
                type="text" 
                class="p-3 bg-gray-100 rounded form-input w-full @error('password') border-red-500 border @enderror" 
                name="title" 
                placeholder="Vacant Title" 
                value="{{ old('title') }}">

            @error('title')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="category" class="block text-gray-700 text-sm mb-2">Category: </label>

            <select 
                name="category" 
                id="category"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                
                <option disabled selected>- Select -</option>

                @foreach($categories as $category)
                    <option 
                        {{ old('category') == $category->id ? 'selected' : ''}}
                        value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="experience" class="block text-gray-700 text-sm mb-2">Experience: </label>

            <select 
                name="experience" 
                id="experience"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                
                <option disabled selected>- Select -</option>

                @foreach($experiences as $experience)
                    <option 
                        {{ old('experience') == $experience->id ? 'selected' : ''}}
                        value="{{ $experience->id }}">
                        {{ $experience->name }}
                    </option>
                @endforeach
            </select>

            @error('experience')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="location" class="block text-gray-700 text-sm mb-2">Location: </label>

            <select 
                name="location" 
                id="location"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                
                <option disabled selected>- Select -</option>

                @foreach($locations as $location)
                    <option 
                        {{ old('location') == $location->id ? 'selected' : ''}}
                        value="{{ $location->id }}">
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>

            @error('location')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="salary" class="block text-gray-700 text-sm mb-2">Salary: </label>

            <select 
                name="salary" 
                id="salary"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                
                <option disabled selected>- Select -</option>

                @foreach($salaries as $salary)
                    <option 
                        {{ old('salary') == $salary->id ? 'selected' : '' }}
                        value="{{ $salary->id }}">
                        {{ $salary->name }}
                    </option>
                @endforeach
            </select>

            @error('salary')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>
        
        <div class="mb-5">
            <label for="description" class="block text-gray-700 text-sm mb-2">Job Description: </label>

            <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700"></div>

            <input type="hidden" name="description" id="description" value="{{ old('description') }}">
            
            @error('description')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="image" class="block text-gray-700 text-sm mb-2">Vacant Image: </label>

            <div id="dropzoneDevJobs" class="dropzone rounded bg-gray-100"></div>

            <input type="hidden" name="image" id="image" value="{{ old('image') }}">

            @error('image')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror

            <p id="error"></p>
        </div>

        <div class="mb-5">
            <label for="skills" class="block text-gray-700 text-sm mb-2">Skills and Knowledge: <span class="text-xs">(Choose at least 3)</span> </label>
            
            @php
                $skills = ['HTML5', 'CSS3', 'CSSGrid', 'Flexbox', 'JavaScript', 'jQuery', 'Node', 'Angular', 'VueJS', 'ReactJS', 'React Hooks', 'Redux', 'Apollo', 'GraphQL', 'TypeScript', 'PHP', 'Laravel', 'Symfony', 'Python', 'Django', 'ORM', 'Sequelize', 'Mongoose', 'SQL', 'MVC', 'SASS', 'WordPress', 'Express', 'Deno', 'React Native', 'Flutter', 'MobX', 'C#', 'Ruby on Rails']
            @endphp

            <skill-list 
                :skills="{{ json_encode($skills) }}"
                :oldskills="{{ json_encode( old('skills')) }}"></skill-list>

            @error('skills')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <button 
            type="submit" 
            class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase">
            Post Vacant
        </button>
    </form>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone-min.js" integrity="sha512-FFyHlfr2vLvm0wwfHTNluDFFhHaorucvwbpr0sZYmxciUj3NoW1lYpveAQcx2B+MnbXbSrRasqp43ldP9BKJcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        Dropzone.autoDiscover = false;
        document.addEventListener('DOMContentLoaded', () => {

            //Medium Editor
            const editor = new MediumEditor('.editable', {
                toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'orderedList', 'unorderedList', 'orderedlist', 'unorderedlist', 'h2', 'h3'],
                    static: true,
                    sticky: true
                },
                placeholder: {
                    text: 'Vacancy information'
                }
            });

            // Add to the hidden input what the user fills in the editor
            editor.subscribe('editableInput', function(eventObj, editable) {
                const content = editor.getContent();
                document.querySelector('#description').value = content;
            });

            // Fill the editor with the content of the input hidden
            editor.setContent(document.querySelector('#description').value)

            //Dropzone
            const dropzoneDevJobs = new Dropzone('#dropzoneDevJobs', {
                url: "/vacancies/image",
                acceptedFiles:  ".png, .jpg, .jpeg, .gif",
                dictRemoveFile: 'Delete File',
                maxFiles: 1,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                init: function() {
                    if(document.querySelector('#image').value.trim()){
                        let postedImage = {};
                        postedImage.size = 12345;
                        postedImage.name = document.querySelector('#image').value;

                        this.options.addedfile.call(this, postedImage);
                        this.options.thumbnail.call(this, postedImage, `/storage/vacancies/${postedImage.name}`);
                        
                        postedImage.previewElement.classList.add('dz-sucess');
                        postedImage.previewElement.classList.add('dz-complete');
                    }
                },
                success: function(file, response) {
                    // console.log(response);
                    // console.log(file);
                    document.querySelector('#error').textContent = '';

                    // Put the response from the server in the input hidden
                    document.querySelector('#image').value = response.correct;

                    // Add the server name to the file object
                    file.serverName = response.correct;
                },
                maxfilesexceeded: function(file) {
                    if(this.files[1] != null) {
                        this.removeFile(this.files[0]); // Delete the old file
                        this.addFile(file); // Add the new file
                    }
                },
                removedfile: function(file, response) {
                    file.previewElement.parentNode.removeChild(file.previewElement);

                    params = {
                        image: file.serverName ?? document.querySelector('#image').value
                    }

                    axios.post('/vacancies/imageDelete', params).then(answer => console.log(answer))
                }
            });
        });
    </script>
@endsection