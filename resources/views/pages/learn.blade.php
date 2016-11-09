@extends('layout')
@section('title', 'Learn')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="candidates" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="upcoming" class="m2-bottom">
                        <h3 class="p1-top m0" @include('edit', ['key' => 'learn_upcoming_title'])>{!! $learn_upcoming_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'learn_upcoming_sessions'])>{!! $learn_upcoming_sessions !!}</div>
                        <hr>
                        <div @include('edit', ['key' => 'learn_upcoming_desc'])>{!! $learn_upcoming_desc !!}</div>
                    </section>
                    <hr>
                    <h3 class="form-title" id="eligibility">Eligibility</h3>
                    <validator name="learn" :groups="['eligibility','register']">
                        <section class="eligiblity-form inset">
                            <p>Please input your zip code</p>
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="m0"><input type="text" name="zip" group="eligibility" v-validate:zip="['required','zip','zipFormat']"></p>
                                    <p class="error m0" v-if="$learn.zip.touched&$learn.zip.zipFormat">Invalid zip code</p>
                                </div>
                            </div>
                            <hr>
                            <p>Do you have a high school diploma or GED?</p>
                            <p><input type="radio" name="education" value="y" group="eligibility" v-validate:education="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="education" value="n" v-validate:education> No</p>
                            <hr>
                            <p>Are you legally able to work in the United States?</p>
                            <p><input type="radio" name="work" value="y" group="eligibility" v-validate:work="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="work" value="n" v-validate:work> No</p>
                            <hr>
                            <p>Do you have access to a laptop (or tablet w/ keyboard) and an internet connection?</p>
                            <p><input type="radio" name="tech" value="y" group="eligibility" v-validate:tech="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="tech" value="n" v-validate:tech> No</p>
                            <hr>
                            <p>Will you adhere to our <a href="https://drive.google.com/file/d/0B28qs3pVLuXSTGhWbU1JWng0YWM/view" target="_blank">Code of Conduct</a>?</p>
                            <p><input type="radio" name="conduct" value="y" group="eligibility" v-validate:conduct="['required','true']"> Yes &nbsp;&nbsp; <input type="radio" name="conduct" value="n" v-validate:conduct> No</p>
                            <div v-if="!$learn.zip.required&!$learn.zip.zipFormat&!$learn.conduct.required&!$learn.work.required&!$learn.education.required&!$learn.tech.required">
                                <hr>
                                <div class="eligibility-result inset">
                                    <p class="m0-bottom" v-if="$learn.eligibility.valid"><span class="fa fa-check fa-2x success"></span> Congratulations, you are eligible to participate in Code Louisville!</p>
                                    <div v-if="$learn.eligibility.invalid">
                                        <p class="m0-bottom"><span class="fa fa-remove fa-2x error"></span> Unfortunately you are not eligible to participate in Code Louisville:</p>
                                        <ul class="m0-bottom">
                                            <li v-if="$learn.zip.invalid">You must reside in an area that Code Louisville serves</li>
                                            <li v-if="$learn.education.invalid">You must have a high school diploma or GED</li>
                                            <li v-if="$learn.work.invalid">You must be legally able to work in the United States</li>
                                            <li v-if="$learn.tech.invalid">You must have access to a laptop (or tablet w/ keyboard) and an internet connection</li>
                                            <li v-if="$learn.conduct.invalid">You must agree to adhere to our Code of Conduct</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="structure" class="m2-bottom">
                            <hr>
                            <h3 class="m0" @include('edit', ['key' => 'learn_program_title'])>{!! $learn_program_title !!}</h3>
                            <hr>
                            <div @include('edit', ['key' => 'learn_program_desc'])>{!! $learn_program_desc !!}</div>
                        </section>
                        <section id="pricing" class="m2-top m2-bottom">
                            <hr>
                            <h3 class="m0" @include('edit', ['key' => 'learn_pricing_title'])>{!! $learn_pricing_title !!}</h3>
                            <hr>
                            <div @include('edit', ['key' => 'learn_pricing_desc'])>{!! $learn_pricing_desc !!}</div>
                        </section>
                        <section id="questions" class="faqs m2-top m2-bottom">
                            <hr>
                            <h3 class="m0" @include('edit', ['key' => 'learn_questions_title'])>{!! $learn_questions_title !!}</h3>
                            <hr>
                            <div @include('edit', ['key' => 'learn_questions_desc'])>{!! $learn_questions_desc !!}</div>
                        </section>
                        <hr>
                        <h3 class="form-title" id="apply">Application</h3>
                        <section class="registration-form inset">
                            @if(Session::has('success'))
                                <div class="inset">
                                    <p class="m0"><span class="fa fa-check success"></span> Thank you for your interest in Code Louisville. We&rsquo;ll be in contact soon.</p>
                                </div>
                            @else
                                <div v-if="$learn.eligibility.valid">
                                    <div class="inset" @include('edit', ['key' => 'learn_form_desc'])>{!! $learn_form_desc !!}</div>
                                    <hr>
                                    <form method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>First name</p>
                                                    <input type="text" name="first" group="register" v-validate:first="['required']">
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Last name</p>
                                                    <input type="text" name="last" group="register" v-validate:last="['required']">
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Email address</p>
                                                    <input type="text" name="email" group="register" v-validate:email="['required','email']">
                                                </label>
                                            </div>
                                        </div>
                                        <div v-if="$learn.register.valid">
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <button type="submit" class="button button-block pink">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div v-if="!$learn.eligibility.valid">
                                    <p class="m0-bottom">You must meet our <a href="#eligibility">eligibility requirements</a> before applying.</p>
                                </div>
                            @endif
                        </section>
                    </validator>
                </div>
                <div class="col-sm-3">
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="752">
                        <h1 class="m0">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="#upcoming">Upcoming sessions</a></li>
                            <li><a href="#eligibility">Eligibility</a></li>
                            <li><a href="#structure">Program structure</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#questions">FAQs</a></li>
                            <li><a href="#apply" class="button pink"><i class="fa fa-clipboard"></i><span>Apply</span><span>Apply</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('vue')

    @include('components.vue')

    <script>
        new Vue({
            el: '#candidates',
            methods: {
                onReset: function () {
                    this.$resetValidation()
                }
            }
        })
    </script>

@endsection
