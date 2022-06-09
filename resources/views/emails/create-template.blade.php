<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<style type="text/css">
    form {
        margin: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            <a class="btn btn-primary" href="{{route('create.template')}}">back</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <form action="{{route('store.template')}}" method="POST">
                    @csrf
                  <div class="form-group">
                    <label for="title">Email Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
                  </div>
                  <div class="form-group">
                    <label for="email_subject">Email Subject</label>
                    <input type="text" class="form-control" id="email_subject" placeholder="Enter email_subject" name="email_subject">
                  </div>
                  <div class="form-group">
                    <label for="email_body">Example Body</label>
                    <textarea class="form-control" id="email_body" rows="3" name="email_body"></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                  </div>
                  
                </form>
            </div>
        </div>
    </div>
</x-app-layout>