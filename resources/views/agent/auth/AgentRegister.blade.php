<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Admit Offer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/stroke.css')}}" rel="stylesheet">
        <script src="https://use.fontawesome.com/72451ebe5b.js"></script>
        <link href="https://use.fontawesome.com/72451ebe5b.css" media="all" rel="stylesheet">
        <link href="{{ asset('css/signin.css')}}" rel="stylesheet">
        <link href="{{ asset('css/custom.css')}}" rel="stylesheet">
        <link href="{{ asset('css/signup.css')}}" rel="stylesheet">
        <link href="{{ asset('css/own.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
    </head>
    <style>
    .blahSize {
        display: none;
        width: 100px;
        height: 100px;
        padding: 8px;
        border-radius: unset;
        border: 2px solid #eaeaea;
        margin-bottom: 10px;
    }
    .blah {
        border-radius: unset;
    }
    </style>
    <body class="text-center signUpbody">
        @if(Session::has('success'))
            <div class="btn btn-success popOver float-right ">
                <div class="btn btn-success">
                    <strong class="text-white">Heads Up!</strong><span class="text-white"> {!!Session::get('success')!!}</span>
                </div>
            </div>
        @endif
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-10 offset-lg-1">
                    <div class="sec1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-12 col-lg-12 part1 border-radius10">
                                <a href="{{route('agent.login')}}" class="btn btn-danger float-right registerBackBtn"><i class="fa fa-arrow-left"></i> Back</a>
                                <div class="login_form">
                                    <h4>Welcome To</h4>
                                    <a href="{{route('agent.login')}}"><img src="{{ asset('images/logo.png')}}"></a>
                                    <div class="small_txt">
                                        <p>Register for most advanced Overseas Education Admission Portal.</p>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li><small>{{ $error }}</small></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form class="form-signin signUp" enctype="multipart/form-data" method="POST" action="{{ route('agents.store') }}" aria-label="{{ __('Register') }}">
                                        @csrf
                                        <div class="login_input">  
                                            <i class="icon icon-User"></i>
                                            <label for="name" class="sr-only">Name </label>  
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  placeholder="Name" required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                         <div class="login_input">  
                                            <i class="icon icon-house"></i>
                                            <label for="name" class="sr-only">Organisation </label>  
                                            <input id="name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}"  placeholder="Organisation" required autofocus>
                                            @if ($errors->has('company_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       
                                        <div class="login_input">
                                            <i class="icon icon-mail"></i>
                                            <label for="inputEmail" class="sr-only">Email address</label>
                                            <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address" name="email" value="{{ old('email') }}" required="">
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="login_input">
                                            <i class="fa fa-phone"></i>
                                            <label for="mobile" class="sr-only">Phone</label>
                                            <input  type="number" id="mobile" placeholder="Phone"  class="form-control{{ $errors->has('mobileno') ? ' is-invalid' : '' }}" name="mobileno" value="{{ old('mobileno') }}" required>
                                            @if ($errors->has('mobileno'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobileno') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <h3 style="color:#b5b3b3;">Registered Address</h3>
                                        <div class="login_input">
                                            <i class="fa fa-map-marker"></i>
                                            <label for="mobile" class="sr-only">Select Country</label>
                                            <select class="form-control" name="country_id" id="country_id" placeholder="Select Country" required>
                                                <option value=''> Select Country</option>
                                                @foreach($countries as $country)
                                                <option value="{{$country['id']}}"> {{$country['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="login_input">
                                            <i class="fa fa-map-marker"></i>
                                            <label for="mobile" class="sr-only">Select State</label>
                                            <select class="mb-2 form-control" placeholder="Select state" name="state_id" id="state_id"  required>
                                                <option value=''> Select State</option>
                                            </select>
                                        </div>
                                        <div class="login_input">
                                            <i class="fa fa-map-marker"></i>
                                            <label for="mobile" class="sr-only">Select City</label>
                                            <select class=" form-control" name="city_id" placeholder="Select city" id="city_id"  required>
                                                <option value=''> Select City</option>
                                            </select>
                                        </div>
                                        <div class="login_input">
                                            <i class="icon icon-address"></i>
                                            <label for="inputPassword" class="sr-only">Address</label>
                                            <textarea class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Address" name="address" style="height: 86px;padding:10px;vertical-align: middle;" required></textarea>
                                            @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                         <div class="row">
                                            <div class="login_input col-md-7 form-group text-left ">
                                                <label class="small_txt">
                                                    <br>
                                                    <p> Upload Your Image</p>
                                                    <p class="text-danger"> <small class="italic" >(Image:- jpg,jpeg,png format only)</small></p>
                                                </label>
                                            </div>
                                            <div class="login_input col-md-5 form-group text-alignWebkit-center">
                                                <div class="blahSize displayNone">
                                                    <img class="blah" src="{{asset('images/site/user-img.png')}}"  />
                                                </div>
                                                <label class="btn btn-lg  btn-block btn2 imgInp"> Browse
                                                <input type="file" name="file" class="mb-2 form-control imgInp" style="display: none;" accept="image/jpeg,image/png" required>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row hide ShowOnlyPunjab">
                                            <div class="login_input col-md-7 form-group text-left">
                                                <label class="small_txt">
                                                    <br>
                                                    <p> License under the - Punjab Travel Professionals Regulation Act 2014</p>
                                                    <p class="text-danger"> <small class="italic" >(Image:- jpg,jpeg,png format only)</small></p>
                                                </label>
                                            </div>
                                            <div class="login_input col-md-5 form-group text-alignWebkit-center">
                                                <div class="blahSize displayNone">
                                                    <img class="blah" src="{{asset('images/site/doc.png')}}"  />
                                                </div>
                                                <label class="btn btn-lg  btn-block btn2 imgInp">Browse
                                                <input type="file" name="document" class="mb-2 form-control imgInp" style="display: none;" accept="image/jpeg,image/png" >
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="login_input col-md-7 form-group text-left">
                                                <label class="small_txt">
                                                    <br>
                                                    <p> Upload Identity Proof</p>
                                                    <p> <small>Passport, Driving License. Aadhar Card ( in italics small font)</small></p>
                                                    <p class="text-danger"> <small class="italic" >(Image:- jpg,jpeg,png format only)</small></p>
                                                </label>
                                            </div>
                                            <div class="login_input col-md-5 form-group text-alignWebkit-center">
                                                <div class="blahSize displayNone">
                                                    <img class="blah" src="{{asset('images/site/doc.png')}}"  />
                                                </div>
                                                <label class="btn btn-lg  btn-block btn2 imgInp"> Browse
                                                <input type="file" name="identity" class="mb-2 form-control imgInp" style="display: none;" accept="image/jpeg,image/png" required>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="login_input col-md-7 form-group text-left">
                                                <label class="small_txt">
                                                    <br>
                                                    <p>Upload Certificate of Incorporation / Shop Establishment Certificate/ Registration Certificate </p>
                                                    <p class="text-danger"> <small class="italic" >(Image:- jpg,jpeg,png format only)</small></p>
                                                </label>
                                            </div>
                                            <div class="login_input col-md-5 form-group text-alignWebkit-center">
                                                <div class="blahSize displayNone">
                                                    <img class="blah" src="{{asset('images/site/doc.png')}}"  />
                                                </div>
                                                <label class="btn btn-lg  btn-block btn2 imgInp"> Browse
                                                <input type="file" name="establishment" class="mb-2 form-control imgInp" style="display: none;" accept="image/jpeg,image/png" required>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="login_input">
                                            <i class="icon icon-ClosedLock"></i>
                                            <label for="inputPassword" class="sr-only">Password</label>
                                            <input type="password" id="inputPassword" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required="">
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="login_input">
                                            <i class="icon icon-ClosedLock"></i>
                                            <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
                                            <input type="password" id="inputConfirmPassword" class="form-control{{ $errors->has('ConfirmPassword') ? ' is-invalid' : '' }}" placeholder="Confirm Password" name="password_confirmation" required="">
                                            @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <p class="form-control" style="height:200px;overflow: scroll;"  >This agreement is between:-
1. AO Technologies Private Limited situated at
XXXXXXXXXXX through its Authorised Signatory Himanshu
Barthwal.
(Hereinafter called AdmitOffer/AO/First Party)

and

2.
_________________________________________________
_________________________________________________
_________________________________________________
__________________Admission Partner (Hereinafter called
AP/Second Party)
It is hereby agreed as follows that First Party/AO and Second
Party/AP have entered into a non-exclusive agreement for
recruitment of international students to United Kingdom, Australia &amp;
New Zealand through Partner Institutes (Hereinafter referred as PI’s)
represented by AO on _______________(Please enter date)
according to the following terms and conditions:- (Any questions
regarding to this Agreement, complaints, claims or other legal
concerns relating to AO or its business, should be directed to AO at
partners@admitoffer.com or AO Technologies Private Ltd, Genesis
Centre, Memorial University of Newfoundland, Signal Hill, Campus,
100, Signal Hill Road #0100, St. John’s, NL A1A1B3, Canada).
1. ‘Definitions’ in this agreement are as under:-
a) ‘Admission Partner’ or ‘AP’ means Second party of this
agreement who is signing this agreement individually or on behalf of
an organization as an authorized signatory
b) ‘Data’ is any information, material, content on the AO website or
provided by AO in its Admit Offer Technology.
c) ‘Partner Institution’ or ‘PI’s’ means any institutions, company
organizations, third party, individuals who have entered into an
agreement with Admit Offer for recruiting students.
d) &quot;Admit Offer Services&quot; means use of AO’s platform for
recruitment of students and other services such as to shortlist
courses, programs offered or run by PI’s within United Kingdom,
Australia &amp; New Zealand. This includes information pertaining to
entry requirements, eligibility, tuition fee, expenses, and visa
information, etc and also application for admission to eligible and
open Programs of such institutions or organizations.

e) ‘Admit Offer Technology’ or ‘AO Tech’ means the AO’s partner
dashboard, portal, website, mobile app, other social media platforms
and any other AO Services, AI based search and continuous
development of its features. This shall include updates made from
time to time.
f) ‘Commission’ means a percentage of the commission that AP
shall receive from the AO for each client enrolled by AP.
g) ‘Confidential Information’ means information digital or physical
of AO having confidential or proprietary value including the AOTech
and Data, it’s all codes and strategies, any software designs,
prototype, compilation of information, data, programs, methods,
business process, license,any information relating to any AO
service, AO software, website, mobile app, social media platforms
online or physical, clients and their information, financial information,
marketing information, intellectual property, business opportunities,
or research and development. This shall also include any
communications made between AO and AP on email, or physically
and telephonically or any communications of PI’s with AO shared by
AO with AP.
h) ‘Client’ means a client recruited through AP by using Admit Offer
Services and its platform.
i) ‘Personal Information’ means information about any student or
client (including any information of proposed or likely to be recruited)
and shall also include any information of any person, employee or
individual associated with any of the parties to this agreement.
j) ‘Program’ or ‘Course’ means any study program, course,
diplomas, degrees, or academic program/course or a combination or
package of Courses/Programs offered by the PI’s.
k) ‘Non-Exclusive Agreement’ means that AP will not have any
exclusive rights to perform the Admit Offer Services set forth herein
or otherwise to promote the AO Services in the city or area of his
operation. It will further means that AO may use other agents,
partners, organizations and any available resources to provide Admit
Offer Services directly in any territory.

2. AO Website and changes to the agreement if any:-
AO reserves his right to change these Terms and Conditions
at any time without any notice and will notify AP by email, in

person, by post or any other suitable method. The AP shall be
bound by the changes so made. The continuous use of the
Admit Offer Services by the AP after such changes having
been made shall be deemed to be the acceptance of such
changes by AP. If the AP doesn’t agree to such changes then
he shall notify the same to AO through e-mail or letter and
shall immediately stop using the AO Tech.
Further, AO reserves the right to change any information,
material or data including Tuition Fee, Expenses, Features,
Content and availability of the AOTech and Admit Offer
Services contained on or provided through the AO website
without any notice.
3. Declaration by AP:-
The AP declares that while entering this agreement or
registering with the AO the AP has provided correct and
genuine information about his own particulars and his
firm/company and also that the documents provided by AP are
genuine and no false or fabricated documents have been
provided;
Further, the AP declares as under that the AP is duly
authorized to enter this agreement and is not incapacitated by
any law to enter these terms and conditions in the country of
his origin and residence;
Further, the AP further declares that at all times and till this
agreement subsists AP shall provide all information,
documentsregarding the clients or any other information
genuinely and shall not conceal any material facts from AO;
Further, the AP also declares that any changes to his
individual particulars or other changes in his firm or company
shall be immediately notified to the AO. Failure on the part of
AP to provide such changed information shall amount to
termination of this agreement;
Further, the AP declares that he shall at all times to come act
with integrity, honesty, ethically and in a responsible manner;
Further, the AP shall advise, inform clients genuinely about
PI’s including the entry requirements, expenses, visa process,
work entitlement, visa conditions, facilities, Programs, Tuition
fees, Cost of living, Campus, Location, refund policies, refund
eligibilities and other requirements and AP shall not conceal
any such material information from the client.
4. Duties and obligations of AP:-

It shall be the duty of the AP to witness and verify all the
documents provided by the client and shall check the
authenticity of the same;
Further, it shall also be the duty of the AP to immediately
transfer all the fees and charges received from client to the
AO;
Further, it shall also be the duty of the AP to provide any offer
documents or communication received from AO to the client
immediately;
Further, it shall also be the duty of AP to ensure the client is
informed about the work restrictions while studying in the PI’s
as an international student and consequences of default;
Further, it shall also be the duty of the AP that if a client’s visa
application is refused the client be advisedabout his
entitlement to a refund if any and also assist the client for
refund of the client’s Tuition fees, FTS, Health cover or any
other refundable fee paid by the client. The AP while providing
services to client shall also apprise the client about the refund
policy of PI’s as applicable and in the event of the failure to
inform the client the AO shall not be responsible for any such
loss suffered by client due to PI’s or any other organization’s
policies;
Further, it shall also be the duty of the AP to update and
provide information as requested by AO, including tuition
deposits, approval letters, decline/refusal letters, concern
letters, any communication by immigration authorities, copy of
visa and any other information requested by AO;
Further, it shall also be the obligation of AP that he shall be
fully responsible for all acts of AP’s sub-agents, authorized
persons, franchisees, employees and that they act and
conduct themselves genuinely and as per the terms and
conditions of this agreement;
Further, it shall also be the duty of AP to support AO’s
employees, team members, directors or any other
representative, to finalize client registrations for the
Program/Course;
Further it shall also be the duty of the AP to immediately
forward to AO any communication or other requests received
by AP from client relating to the AO Services.

5. Change of agent:-
AP herein agrees that if a client intends to use a different AP
in place of existing or initial AP, in that eventuality AO
reserves the right to replace an AP;
Further, if a client intends to use another AP in place of
existing AP, the AP should follow the policy and procedures
provided by AO for change of AP;
Further if a client submit AP change form or directly requests
at any time to AO before the deposit of tuition fee having been
received by the PI in United Kingdom, submission of GTE
documents received by PI in Australia and submission of visa
application with Immigration New Zealand in New Zealand the
AO shall be free to change such AP;
Further, the complete policy and procedure that a client or AO
Partner must follow for change of AP can be found at
www.admitoffer.com and such policy and procedures may be
updated by AO at any time. In the process if necessitated the
AO may contact each Client directly or with AP’s assistance to
confirm a change of AP.
6. Use of name, logo or other information:-
The AP agrees that AP is authorized only to represent AO
under this Agreement and not any of PI’s to which Clients may
apply through the AO Services, and therefore must not use
the name, logo or other information of PI’s while using Admit
Offer Services.
7. Commission for AO Services:-
a. All applications for AO Services submitted by AP on behalf
of a Client will be subject to sole discretion of AO. AO
reserves the right to accept or reject any application.
b. The charges and other terms of the AO Services will be
determined solely by AO.
8. AP’s covenants, represents and warrants:-
That AP has the full power to enter into this Agreement and to
perform AP’s obligations hereunder;
That the AP has acquired necessary licenses, registration and
permissions to perform the Admit Offer Services;

That the AP will work in compliance with all its obligations and
binding requirements of this agreement;
That the AP will conduct the business activities and recruit
clients in an ethical manner and will not do any actions that
can harm the reputation of AO or the Admit Offer Services;
That the AP will not make any guarantees to clients about
whether they will be granted a student visa;
That the AP will not engage in false or misleading
advertisements or statements;
That the AP will not make any false representations,
warranties or guarantees about AO, the AO Services, or any
PI’s available through the AO Services;
That the AP will not use marketing and informational material
unless provided by or approved by AO;
That the AP will, at all times, charge Clients a reasonable fee
for the services provided by AP;
That the AP will not disclose the Confidential information or
personal information of any Client to any third party;
That the AP will respond to any information request by AOand
furnish documents if applicable;
That the AP will not provide any immigration advice to clients
unless the AP is meeting the applicable compliance of the
country the client is recruited to;
That the AP will provide such immigration advice to clients
only if the AP is having the required registration/License
applicable in the country of AP;
That the AP will not charge any fees if not permitted by the
applicable law.
9. Suspension and Termination of agreement or Services:-
If at any point of time AO becomes aware that AP has failed to
comply with any of AP’s duties or obligations in this
Agreement, including if AO becomes aware that AP, an
individual counsellor employed by AP, sub-agent, franchisee,
family member, branch office of AP has committed any breach
of this Agreement, then the AO reserves the right to either
suspend AP’s ability to use the Admit Offer Services and

AOTech or the AO may put AP on probation, for a period
determined by AO;
Further, if AP is suspended or this Agreement is terminated,
for whatever reason, AO reserves the right, without limiting its
other rights and remedies, to directly contact any of AP’s
Clients;
Further, if AP is suspended or this Agreement is terminated,
for whatever reason, AO reserves the right, without limiting its
other rights and remedies, to notify PI’s and publish a notice
regarding AP’s suspension or termination. AP will not be
entitled to any Commission for any Client who is not, at the
time, enrolled with a PI;
Further the AO may suspend or terminate AP’s use of the
Admit Offer Technology if AP does not use the Admit Offer
Technology on a regular basis. AO can also suspend or
terminate Admit Offer Technology of AP if AO believes that AP
is using or misusing Admit Offer Technology for the sole
purpose of program shortlisting and is not recruiting any
clients on Admit Offer Technology intentionally;
Further, if a AP is suspended for non-use of the Admit Offer
Technology or commits a breach of this Agreement or other
Event of Default, any Clients listed under a AP’s profile will
revert back to the common pool within the Admit Offer
Technology, and if any Client applies through another AP or
directly to AO, in addition to AP, such Clients will be removed
from AP’s dashboard of Admit Offer Technology;
Further, during a period of suspension, AP cannot apply for
new Clients;
Further, during a period of suspension, AP cannot apply for
new Programs for existing Clients however AP can access all
existing Clients of AP and can communicate with AO for such
Clients. A suspension does not mean AP’s account has been
terminated. If suspended AP should contact AP’s Relationship
Manager directly or via e-mail at partners@admitoffer.com.
10. AO Obligations:-
During the subsistence of this agreement AO will provide AP
with AO Team, Services, information, sales and other
assistance as may reasonably be necessary for AP to perform
the Admit Offer Services;

Further, from time to time, AO may provide written or
electronic materials to AP to aid in the performance of the
Admit Offer Services. AP will use such materials only for the
purpose of providing the Admit Offer Services and specifically
for the purposes specified by AO in relation to such materials,
and will not misuse such materials, including to represent the
Admit Offer Services inaccurately or to provide to any
competitor or unauthorized person of AO.
11. AP Commission:-
Subject to AP’s compliance with the terms of this Agreement,
and in consideration for AP’s provision of the Admit Offer
Services, AO will pay a commission for any Client that AP
successfully recruits, based on the estimated commission
shown on AO Team or on the AO website being a percentage
of the commission that AO receives from the PI. AP
acknowledges that the actual Commission paid could be
different as shown on the dashboard due to Data error;
Further, the AP will receive the Commission within 4 weeks
after AO receives the funds from the PI when the Client has
landed in either UK, Australia &amp; NZ;
Further, if the commission is not received by the AO because
of any of the following reasons then the AO will not be liable to
pay the commission to AP:-
a) if the Client has not enrolled itself with the PI after getting
visa and landing in the respective country;
b) if the client has not attended the minimum number of
classes as required by the PI;
c) if the client withdraws from the program and does not begin
studies for any reason;
d) if the client is not granted the study permit by the
competent authority;
e) if the client does not pay his or her tuition fee; or
f) if the PI shuts its operations due to any reasons such as
but not limited to Bankruptcy, Natural calamity or disaster,
cancellation of registration/license, epidemic etc.
Further, if at any point of time the client leaves the course and
the PI is required to refund the tuition fees and the AO has to
refund the commission to PI for any reasons then AP will have
to refund the commission paid to him. The amount of refund
can also be adjusted in other payments to be made by AO to
AP;

Further, it is clarified that the actual amount of a refund paid
by an PI is not controlled by AO and is subject to each of the
PI’s policies;
Further, if more than one AP makes a claim for a Commission
for the same Client, payment of the Commission will be made
to AP that has submitted a tuition receipt on behalf of the
Client initially;
Further, the AP will not receive Commission for Clients who
will become Permanent Resident, citizens, or conditional
permanent residents, or who hold other eligible non-citizen
immigration visas making them eligible as domestic clients for
purpose of Tuition fee payment. and if fraudulent documents
are submitted to AO, immigration authorities, PI’s or any other
related organization on behalf of a Client or if an AP provides
fraudulent advice to a Client;
Further, in case of any dispute regarding payment of
commission to an AP, the decision of the AO shall be final and
binding.
12. AP Expenses:-
AP will be solely responsible for all expenses incurred as a
direct or indirect result of the performance of the Admit Offer
Services, including rents, salaries, expenses for advertising,
promotional activities, travelling to roadshows, and meeting
Clients.
Further, AP will pay all applicable taxes including, but not
limited to taxes such as GST, Income Tax etc on its own
independently.
13. Invoice to receive Commission:-
AP will create an AO invoice and provide information as
requested by AO. AP must use the invoice template provided
by AO to generate invoice.
14. AO’s assistance &amp; monitoring:-
That AO will provide AP with sufficient hard and soft marketing
material regarding the PI’s and their Programs to assist AP to
run the Admit Offer Services;
Further, AO will duly process all completed applications
received (but is under no obligation to accept any Clients
referred by AP); and

Further, AO will regularly monitor the activities of AP, perform
regular meetings, correspond ask for reports detailing Client
enrolment processes, progress and outcomes, in addition to
asking information regarding AP’s activities via Client and
parent feedback.
15. Confidential Information:-
That during the term of this agreement and also in the event of
renewal, suspension, termination or expiry of agreement AP is
liable not to copy, disclose, transfer, divulge, provide, mirror,
scrape, use robots, reproduce any information regarding
Admit Offer Services to a third party;
Further, AP on demand of AO will immediately return to all
Confidential Information which is in AP’s possession;
Further, if any breach is made by the AP then AO will be
entitled to seek appropriate injunction from the competent
court for enforcement of the AP’s obligations;
Further, AP at any stage has to disclose any information then
the same can only be to the extent that is required by law to
do and in such an event the AP will notify the AO so that the
AO may seek necessary orders for limiting or precluding such
disclosure.
16. Restraint from Solicitation and Competition:-
That during the Term and for a period of one year after the
termination or expiry of this Agreement, the AP will not enroll
or solicit clients for the PI’s which are on the Admit Offer
services and Admit Offer Technology;
Further, the AP will not employ any employee of AO or enter
in an agreement with AO’s current or former employee to
recruit for any PI;
Further, the AP shall not directly compete with AO during the
subsistence of this agreement or one year after the expiry or
termination of this agreement;
Further, AP acknowledges that on breach of this Section the
AO can seek injunction from the competent court or authority.
17. Intellectual Property:-
That AP acknowledges that they do not acquire any
intellectual property or other proprietary rights under this
Agreement, including any right, title or interest in and to

patents, copyrights, trademarks, industrial designs,
confidential information, or trade secrets, whether registered
or unregistered, relating to the Admit Offer Services or Admit
Offer Technology;
Further, AP must not copy any kind of content from Admit
Offer Technology for Creating a competing website,
technology or service.
18. Term of agreement:-
That the term of this Agreement will be for ____ years/months
and can be renewed with consent of both parties.
19. Early termination of agreement:-
That this agreement may be terminated by either Party for any
reason with a 30 days written notice by email or post;
Further, AO can investigate actions of AP in case of any kind
of breach such as misleading advertisements, submission of
fake documents, overcharging of professional fee and if on
investigation it is found that AP has committed any of the
above breach the agreement can be terminated by AO
forthwith;
Further, AO can immediately terminate this agreement if AP
commits a breach of any terms and conditions of this
Agreement and does not adhere or comply by any direction
from AO to rectify the breach.
20. Consequences on Termination or Expiry:-
That upon termination or expiry of this Agreement, AP must
immediately cease holding itself out as authorized to recruit on
behalf of AO immediately and cease to provide Admit Offer
Services for AO.
21. Disclaimer:-
That AP will be solely responsible for all of the Admit Offer
Services and activities undertaken under this Agreement. AO
expressly disclaims all liability for any claims, losses or
damages arising out of such Admit Offer Services and
activities, including any claims, losses or damages relating to
false representations made by AP to Clients or other third
parties;
Further, the Admit Offer Technology and the Data are
provided “as is” without warranty or condition of any kind;

Further, use of the Admit Offer Technology or the Data is at
AP’s own risk. The Admit Offer Technology and the Data may
include errors, omissions and inaccuracies, including pricing
errors. AO does not assume any responsibility for these
errors, omissions or inaccuracies. In addition, AO reserves the
right to correct any pricing errors on the Admit Offer
Technology. AO makes no guarantees about the availability of
specific services.
22. Set-off and Indemnities:-
That AP shall defend, indemnify and hold harmless AO and all
of its officers, directors, employees and agents from and
against any claims, causes of action, demands, recoveries,
losses, damages, fines, penalties or other costs or expenses
of any kind or nature including reasonable legal and
accounting fees for the losses suffered by AO on the breach of
any of the AP’s declarations, covenants, warrants,
representations, duties or obligations under these Terms and
Conditions, including AP’s violation of any Applicable Law;
Further, the AP shall indemnify AO for any loss suffered by
AO for any act or action of AP infringing, misappropriating or
violating of the rights of a third party, including any intellectual
property rights;
Further, the AP shall also indemnify AO for any losses
suffered by AO due to wrongful or unauthorized use of the
Admit Offer Technology or the Data by AP;
Further, the AP shall also indemnify AO for any losses
suffered by it due to some conduct, act or omission committed
by the AP for which AP was never granted permission by AO
or was beyond the terms of this agreement, and this shall also
include any conduct, act or omission committed by AP the
scope of which has not been defined in this agreement but still
the AO suffers any kind of loss;
Further, AO can set off or adjust any pending invoices of the
AP for the losses suffered by AO due to the above reasons
explained.
23. Limit of Liability
AO will not be liable at any stage for any loss suffered by the
AP due to any reason not set out in this agreement or for any
loss due to any use of or inability to use AO Tech or Data;

Further the AO will not be liable for any fines, fees, penalties
or other liabilities the AP may suffer during the use of the AO
tech or AO Services.

24. Other General terms and Conditions:-
AP agrees that it will not upload to or transmit through the AO
Technology any content or submission that is offensive,
seditious hateful, obscene, defamatory or violates any
applicable laws;
Further, The AO Technology may provide links to third party
websites, including to those of PI’s. AO does not endorse the
information contained on those web sites;
Further, the downloading and viewing of Data is done at AP’s
own risk. AO cannot guarantee that the AO Tech or the
Content, or any links from the AO Tech or the Content, will be
free of viruses;
Further, neither of the Party will be liable for delays caused by
any event beyond its reasonable control, except non-payment
of amounts due under this Agreement will not be excused by
this provision;
Further, any notices, reports or other communications required
or permitted to be given under this Agreement will be in
writing, including email, and will be sufficient if delivered by
hand or sent by registered mail, courier or facsimile addressed
to AP or AO at their respective addresses as advised in
writing. Any such notices, reports, or other communications
will be deemed to have been received by the Party to whom
they were addressed;
Further, the AP will be primarily responsible for the
performance of all of AP’s obligations in this Agreement
including its subagents if any. The AO will not be responsible
for any wrongful act of the AP’s sub agent.

25. Jurisdiction and dispute resolution:-
That in case of any dispute between the parties the jurisdiction
of Ontario, Canada will be applicable and the same shall be
subject to the courts situated at Ontario, Canada.

I, __________________ (AP) acknowledge that I have read and
agree to the above Terms and Conditions. I acknowledge that I am
authorized to sign this Agreement.
                                        </p>
                                        <div class="checkbox mb-3 float-left small_txt hide ShowOnlyChd" >
                                           
                                                <label class="containerCheckBox"><small style="color:#b1b1b1" ><span style="font-size: 12px; color: #b1b1b1; margin-bottom: 0;"></span>Do you have SSP office certificate ?</span></small>
                                                    <input id="gender" type="checkbox" name="sspoffice" class="ifChdReq mb-2 displayNone"    >   
                                                    <span class="checkmarked"></span>
                                                </label>
                                        </div>
                                        <div class="checkbox mb-3 float-left small_txt" >
                                           
                                                <label class="containerCheckBox"><small style="color:#b1b1b1" ><span style="font-size: 12px; color: #b1b1b1; margin-bottom: 0;"></span>I have read the terms & conditions and I agree that I shall abide by the policies, T&C's of Admit Offer Technologies Ltd, Canada.</span></small>
                                                    <input id="gender" type="checkbox" name="checkprivacy" class="checkprivacy mb-2 displayNone" value="remember-me"  required  >    
                                                    <span class="checkmarked"></span>
                                                </label>
                                        </div>
                                        <button class="btn btn-lg  btn-block btn2" id="checkprivacy" type="submit" disabled>Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------- sec1 end --------->
                </div>
            </div>
            <div class="row loginRegisterFooter" >
                <div class="col-md-12">
                    <div class="footer text-center" >
                        <div class="small_txt">
                            <!-- <p>© Copyright 2019 . All Rights Reserved by  Admit Offer Technologies Ltd.</p> -->
                            <p>© Copyright 2019 . All Rights Reserved by  Supernova Edu Technologies Inc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('admins/js/custom.js')}}" ></script>
        <script type="text/javascript" src="{{ asset('admins/js/location.js')}}" ></script>
    </body>
</html>