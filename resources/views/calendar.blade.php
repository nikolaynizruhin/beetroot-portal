@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-calendar-alt fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Calendar
                </div>

                <div class="card-body">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item"
                                src="https://calendar.google.com/calendar/b/1/embed?title=Beetroot%20Events&amp;showTitle=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=beetroot.se_c62vgouj263dvt76r4dp8cmaeo%40group.calendar.google.com&amp;color=%23182C57&amp;src=beetroot.se_48f6biue7jifum33m0j1404fl0%40group.calendar.google.com&amp;color=%23853104&amp;src=beetroot.se_lh0hfv18v2g6lsc7dcq6r06ogg%40group.calendar.google.com&amp;color=%2329527A&amp;src=beetroot.se_fd71bppbcif2eihu9gv09lnnvo%40group.calendar.google.com&amp;color=%23333333&amp;src=beetroot.se_mqvlvsr82ml07hasqla63uvsh0%40group.calendar.google.com&amp;color=%235229A3&amp;ctz=Europe%2FKiev"
                                scrolling="no">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
