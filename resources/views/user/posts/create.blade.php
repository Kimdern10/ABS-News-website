@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">


            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">
                        Submit Eyewitness News
                    </h4>

                </div>


                <div class="card-body">


                    {{-- Success Message --}}
                    @if(session('success'))

                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                    @endif



                    {{-- Validation Errors --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif




                    <form action="{{ route('user.eyewitness.store') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf



                        {{-- Title --}}
                        <div class="mb-3">

                            <label class="form-label">
                                News Title
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title') }}"
                                   placeholder="Enter eyewitness news title">

                        </div>




                        {{-- Content --}}
                        <div class="mb-3">

                            <label class="form-label">
                                News Description
                            </label>


                            <textarea name="content"
                                      rows="6"
                                      class="form-control"
                                      placeholder="Write your eyewitness report">{{ old('content') }}</textarea>

                        </div>




                        {{-- Location --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Location
                            </label>


                            <input type="text"
                                   name="location"
                                   class="form-control"
                                   value="{{ old('location') }}"
                                   placeholder="Where did this happen?">

                        </div>




                        {{-- Image --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Upload Image
                            </label>


                            <input type="file"
                                   name="image"
                                   class="form-control">


                            <small class="text-muted">
                                Upload a clear image related to the news.
                            </small>

                        </div>




                        {{-- Submit Button --}}
                        <div class="d-flex justify-content-end">

                            <button type="submit"
                                    class="btn btn-primary">

                                Submit News

                            </button>

                        </div>


                    </form>


                </div>

            </div>


        </div>

    </div>

</div>


@endsection