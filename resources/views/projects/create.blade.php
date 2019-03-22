@extends('layouts.app')
    @section('content')
    <form method="POST" action="/projects">

        @csrf
        
        <h1 class="heading is-1">Create a Project</h1>

        <div class="field">
            <label for="title" class="label">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title">
            </div>
        </div>

        <div class="field">
            <label for="description" class="label">Description</label>
        </div>

        <div class="control">
            <textarea name="description" class="textarea"></textarea>
        </div>

        <div class="field" style="padding-top:30px">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    </form>
    @endsection