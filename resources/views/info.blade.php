@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Information
                </div>

                <div class="card-body">
                    <p>Hej!</p>

                    <p>Welcome to the Family Portal! We are extremely glad you are a part of our growing family.</p>

                    <p>Here is some useful information which is supposed to help you in daily life at Beetroot.</p>

                    <ul>
                        <li>
                            As a huge family we have some traditions: gathering for breakfasts and brunches all together, office warming parties to celebrate moving to new homes, Friday after work activities - you are welcome to join them all!
                        </li>
                        <li>
                            Planning a day off or a vacation? First of all, notify your client about it. Also, drop a note to your local management <a href="mailto:kievmanagement@beetroot.se">kievmanagement@beetroot.se</a> / <a href="mailto:poltavamanagement@beetroot.se">poltavamanagement@beetroot.se</a> / <a href="mailto:odessamanagement@beetroot.se">odessamanagement@beetroot.se</a> if you plan one of those or intend to work on the weekend or holiday. Let us know about it to be sure that you can access the office.
                        </li>
                        <li>
                            You have an opportunity to use a self-development bonus which also covers events competence and equals 100$/calendar year (applicable after the trial period). Please, approach your local management to receive it.
                        </li>
                        <li>
                            As we have static IP your client can add it to his list of trusted addresses. In case you need VPN connection for working purposes, please, approach your SysAdmin.
                        </li>
                        <li>
                            Important: We <strong>do not recommend</strong> visiting websites with suspicious content which could damage not only your PC, but the whole system.
                        </li>
                        <li>
                            We only use licensed software. To agree upon purchasing software or compensating of expenses, please, approach your local management.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
