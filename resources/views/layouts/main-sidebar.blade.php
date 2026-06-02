<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('dashboard') }}" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('main-translation.Dashboard') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
            
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main-translation.Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('grade.index') }}">{{trans('main-translation.Grades_list')}}</a></li>
                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('main-translation.classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('classroom.index') }}">{{ trans('main-translation.List_classes') }}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item todo-->
                      <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements1">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main-translation.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements1" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('section.index') }}">{{trans('main-translation.List_sections')}}</a></li>
                        </ul>
                    </li>
                    <!-- student sidebar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements2">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main-translation.students')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements2" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('student.create') }}">{{trans('main-translation.add_student')}}</a></li>
                            <li><a href="{{ route('student.index') }}">{{trans('main-translation.list_students')}}</a></li>
                            <li><a href="{{ route('promotion.index') }}">{{trans('main-translation.Students_Promotions')}}</a></li>
                            <li><a href="{{ route('promotion.create') }}">{{trans('main-translation.list_Promotions')}}</a></li>
                            <li><a href="{{ route('graduate.create') }}">{{trans('main-translation.add_Graduate')}}</a></li>
                            <li><a href="{{ route('graduate.index') }}">{{trans('main-translation.list_Graduate')}}</a></li>
                        </ul>
                        
                    </li>
                    <!-- menu item mailbox-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements3">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main-translation.Teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements3" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('teacher.index') }}">{{trans('main-translation.List_Teachers')}}</a></li>
                        </ul>
                    </li>
                    <!-- menu item Charts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">{{ trans('main-translation.Parents') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ url('parent') }}">{{ trans('main-translation.List_Parents') }}</a> </li>
                        </ul>
                    </li>

                    <!-- menu font icon-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('main-translation.Accounts') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('fee.index') }}">{{ trans('main-translation.fee') }}</a> </li>
                            <li> <a href="{{ route('fee_invoice.index') }}">{{ trans('main-translation.fee_invoice') }}</a> </li>
                            <li> <a href="{{ route('receipt_student.index') }}">{{ trans('main-translation.receipt_student') }}</a> </li>
                            <li> <a href="{{ route('processing_fee.index') }}">{{ trans('main-translation.processing_fee') }}</a> </li>
                            <li> <a href="{{ route('payment.index') }}">{{ trans('main-translation.payment') }}</a> </li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements4">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main-translation.Attendance')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements4" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('attendance.index') }}">{{trans('main-translation.list_students')}}</a></li>
                        </ul>
                    </li>
                    {{-- subject --}}
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements7">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main-translation.subject')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements7" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('subject.index') }}">{{trans('main-translation.list_subject')}}</a></li>
                        </ul>
                    </li>
                    <!-- exam item Form-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Form">
                            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">{{ trans('main-translation.Exams') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Form" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('exam.index') }}">{{ trans('main-translation.list_exam') }}</a> </li>
                            <li> <a href="{{ route('quizz.index') }}">{{ trans('main-translation.list_quizz') }}</a> </li>
                            <li> <a href="{{ route('question.index') }}">{{ trans('main-translation.list_question') }}</a> </li>

                        </ul>
                    </li>
                    <!-- library item table -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">{{ trans('main-translation.library') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('library.index') }}">{{ trans('main-translation.list_library') }}</a> </li>
                        </ul>
                    </li>
                    <!-- setting item Authentication-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{ trans('main-translation.Settings') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="login.html">login</a> </li>
                            <li> <a href="register.html">register</a> </li>
                            <li> <a href="lockscreen.html">Lock screen</a> </li>
                        </ul>
                    </li>
                    <!-- menu item maps-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements5">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main-translation.Users')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements5" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('grade.index') }}">{{trans('main-translation.Grades_list')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
