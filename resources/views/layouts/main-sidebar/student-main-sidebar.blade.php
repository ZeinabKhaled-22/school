<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dashboard.student') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main-translation.Dashboard_student')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main-translation.Programname')}} </li>


        <!-- الامتحانات-->
        <li>
            <a href="#"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main-translation.Exams') }}</span></a>
        </li>
{{-- //{{route('student_exam.index')}} --}}

        <!-- Settings-->
        <li>
            <a href="#"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('main-translation.profile') }}</span></a>
        </li>
{{-- {{route('profile-student.index')}} --}}
    </ul>
</div>