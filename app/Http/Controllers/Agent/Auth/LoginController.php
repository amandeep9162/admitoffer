<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use App\Agent;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/agent';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('agent.guest:agent', ['except' => 'logout']);
    }

    public function login(Request $request){
        
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $isExist = Agent::where('email',$request->email)->first();
        if($isExist){
            if($isExist['status'] != 1){
                return back()->withErrors(['Account still verifying by ADMITOFFER Team']);
            }
        }

        if(Auth::guard('agent')->attempt(['email'=>$request->email,'password'=>$request->password, 'status'=>1])){
            // PendancyAttachment::where()
        $today =  date('Y-m-d H:i:s');
        Agent::where('email',$request->email)->update(['last_login'=> $today]);
            return redirect()->route('agent.dashboard');
        } else{
            
            return back()->withErrors(['These credentials do not match our records.']);
        }       

        dd($request->all());

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('agent');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('agent.auth.login');
    }
    public function thankYou($id)
    {
        $id = base64_decode($id);
        return view('agent.auth.thankyou',compact('id'));
    }
     public function createPdf($id)
    {
        $id = base64_decode($id);
        $pdf = App::make('dompdf.wrapper');
        $agent = Agent::where('id',$id)->first();
        
        $pdf->loadHTML('<h1 style="text-align:center;color:white;"><img src="images/logo.png"> </h1>
            <h4 ><strong style="color:#e77817; text-transform:uppercase;">Name: </strong><span style="text-transform:uppercase;">'.$agent['name'].'</span></h4>
            <h5><strong style="color:#e77817; text-transform:uppercase;">Company Name: </strong>'.$agent['company_name'].'</h5>
            <h5><strong style="color:#e77817; text-transform:uppercase;">Email: </strong>'.$agent['email'].'</h5>
            <h5><strong style="color:#e77817; text-transform:uppercase;">Phone: </strong>'.$agent['mobileno'].'</h5>
            <h5><strong style="color:#e77817; text-transform:uppercase;">Country: </strong>'.$agent->country['name'].'</h5>
            <h5><strong style="color:#e77817; text-transform:uppercase;">State: </strong>'.$agent->state['name'].'</h5>
            <h5><strong style="color:#e77817; text-transform:uppercase;">City: </strong>'.$agent->city['name'].'</h5>
            <h5><strong style="color:#e77817; text-transform:uppercase;">Address: </strong>'.$agent['address'].'</h5>
             <h5><strong style="color:#e77817; text-transform:uppercase;">Registration IP : </strong>'.$agent['ip_address'].'</h5>
            <h5><strong style="color:#e77817; text-transform:uppercase;">Registration Date: </strong>'.$agent['created_at']->format('d/m/Y').'</h5>
            <ol style="margin:0px;padding:0px;">

<strong>This agreement is between:-</strong>
<li> ADMIT OFFER TECHNOLOGIES INC. situated at Genesis Centre, 100 Signal Hill Rd #0100, St. Johns, NL A1A 1B3, Canada through its Authorised Signatory Himanshu Barthwal
(Hereinafter called AdmitOffer/AO/First Party)
and  '.$agent['name'].', '.$agent['company_name'].'  (Hereinafter called Admission Partner/AP/Second Party).
It is hereby agreed as follows that First Party/AO and Second Party/AP have entered into a non-exclusive agreement for recruitment of international students to United Kingdom, Australia & New Zealand through Partner Institutes (Hereinafter referred as PI’s) represented by AO on '.$agent['created_at']->format('d/m/Y').' according to the following terms and conditions:- (Any questions regarding to this Agreement, complaints, claims or other legal concerns relating to AO or its business, should be directed to AO at partners@admitoffer.com or  ADMIT OFFER TECHNOLOGIES INC., Genesis Centre, Memorial University of Newfoundland, Signal Hill, Campus, 100, Signal Hill Road #0100, St. John’s, NL A1A1B3, Canada).</li>



<li style="list-style:none;margin-top:10px;">&lsquo;<strong>Definitions&rsquo; </strong>in this agreement are as under:-</li>
<li style="list-style:none;margin-top:10px;">a) <strong>&lsquo;Admission Partner&rsquo; or &lsquo;AP&rsquo;</strong> means Second party of this agreement who is signing this agreement individually or on behalf of an organization as an authorized signatory</li>
<li style="list-style:none;margin-top:10px;">b) <strong>&lsquo;Data&rsquo;</strong> is any information, material, content on the AO website or provided by AO in its Admit Offer Technology.</li>
<li style="list-style:none;margin-top:10px;">c) &lsquo;<strong>Partner Institution&rsquo; or &lsquo;PI&rsquo;s&rsquo;</strong> means any institutions, company organizations, third party, individuals who have entered into an agreement with Admit Offer for recruiting students.</li>
<li style="list-style:none;margin-top:10px;">d) <strong>"Admit Offer Services"</strong> means use of AO&rsquo;s platform for recruitment of students and other services such as to shortlist courses, programs offered or run by PI&rsquo;s within United Kingdom, Australia &amp; New Zealand. This includes information pertaining to entry requirements, eligibility, tuition fee, expenses, and visa information, etc and also application for admission to eligible and open Programs of such institutions or organizations.</li>
<li style="list-style:none;margin-top:10px;">e) <strong>&lsquo;Admit Offer Technology&rsquo; </strong>or <strong>&lsquo;AO Tech&rsquo; </strong>means the AO&rsquo;s partner dashboard, portal, website, mobile app, other social media platforms and any other AO Services, AI based search and continuous development of its features. This shall include updates made from time to time.</li>
<li style="list-style:none;margin-top:10px;">f) <strong>&lsquo;Commission&rsquo;</strong> means a percentage of the commission that AP shall receive from the AO for each client enrolled by AP.</li>
<li style="list-style:none;margin-top:10px;">g) <strong>&lsquo;Confidential Information&rsquo;</strong> means information digital or physical of AO having confidential or proprietary value including the AOTech and Data, it&rsquo;s all codes and strategies, any software designs, prototype, compilation of information, data, programs, methods, business process, license,any information relating to any AO service, AO software, website, mobile app, social media platforms online or physical, clients and their information, financial information, marketing information, intellectual property, business opportunities, or research and development. This shall also include any communications made between AO and AP on email, or physically and telephonically or any communications of PI&rsquo;s with AO shared by AO with AP.</li>
<li style="list-style:none;margin-top:10px;">h) <strong>&lsquo;Client&rsquo;</strong> means a client recruited through AP by using Admit Offer Services and its platform.</li>
<li style="list-style:none;margin-top:10px;">i) <strong>&lsquo;Personal Information&rsquo;</strong> means information about any student or client (including any information of proposed or likely to be recruited) and shall also include any information of any person, employee or individual associated with any of the parties to this agreement.</li>
<li style="list-style:none;margin-top:10px;">j) <strong>&lsquo;Program&rsquo; or &lsquo;Course&rsquo;</strong> means any study program, course, diplomas, degrees, or academic program/course or a combination or package of Courses/Programs offered by the PI&rsquo;s.</li>
<li style="list-style:none;margin-top:10px;">k) <strong>&lsquo;Non-Exclusive Agreement&rsquo;</strong> means that AP will not have any exclusive rights to perform the Admit Offer Services set forth herein or otherwise to promote the AO Services in the city or area of his operation. It will further means that AO may use other agents, partners, organizations and any available resources to provide Admit Offer Services directly in any territory.</li>
</ol>
<p>&nbsp;</p>
<p>&nbsp;</p>
<ol start="2">
<li><strong> AO Website and changes to the agreement if any:-</strong></li>
</ol>
<p>AO reserves his right to change these Terms and Conditions at any time without any notice and will notify AP by email, in person, by post or any other suitable method. The AP shall be bound by the changes so made. The continuous use of the Admit Offer Services by the AP after such changes having been made shall be deemed to be the acceptance of such changes by AP. If the AP doesn&rsquo;t agree to such changes then he shall notify the same to AO through e-mail or letter and shall immediately stop using the AO Tech.</p>
<p>Further, AO reserves the right to change any information, material or data including Tuition Fee, Expenses, Features, Content and availability of the AOTech and Admit Offer Services contained on or provided through the AO website without any notice.</p>
<ol start="3">
<li><strong>Declaration by AP:-</strong></li>
</ol>
<p>The AP declares that while entering this agreement or registering with the AO the AP has provided correct and genuine information about his own particulars and his firm/company and also that the documents provided by AP are genuine and no false or fabricated documents have been provided;</p>
<p>Further, the AP declares as under that the AP is duly authorized to enter this agreement and is not incapacitated by any law to enter these terms and conditions in the country of his origin and residence;</p>
<p>Further, the AP further declares that at all times and till this agreement subsists AP shall provide all information, documentsregarding the clients or any other information genuinely and shall not conceal any material facts from AO;</p>
<p>Further, the AP also declares that any changes to his individual particulars or other changes in his firm or company shall be immediately notified to the AO. Failure on the part of AP to provide such changed information shall amount to termination of this agreement;</p>
<p>Further, the AP declares that he shall at all times to come act with integrity, honesty, ethically and in a responsible manner;</p>
<p>Further, the AP shall advise, inform clients genuinely about PI&rsquo;s including the entry requirements, expenses, visa process, work entitlement, visa conditions, facilities, Programs, Tuition fees, Cost of living, Campus, Location, refund policies, refund eligibilities and other requirements and AP shall not conceal any such material information from the client.</p>
<ol start="4">
<li><strong> Duties and obligations of AP:-</strong></li>
</ol>
<p>It shall be the duty of the AP to witness and verify all the documents provided by the client and shall check the authenticity of the same;</p>
<p>Further, it shall also be the duty of the AP to immediately transfer all the fees and charges received from client to the AO;</p>
<p>Further, it shall also be the duty of the AP to provide any offer documents or communication received from AO to the client immediately;</p>
<p>Further, it shall also be the duty of AP to ensure the client is informed about the work restrictions while studying in the PI&rsquo;s as an international student and consequences of default;</p>
<p>Further, it shall also be the duty of the AP that if a client&rsquo;s visa application is refused the client be advisedabout his entitlement to a refund if any and also assist the client for refund of the client&rsquo;s Tuition fees, FTS, Health cover or any other refundable fee paid by the client. The AP while providing services to client shall also apprise the client about the refund policy of PI&rsquo;s as applicable and in the event of the failure to inform the client the AO shall not be responsible for any such loss suffered by client due to PI&rsquo;s or any other organization&rsquo;s policies;</p>
<p>Further, it shall also be the duty of the AP to update and provide information as requested by AO, including tuition deposits, approval letters, decline/refusal letters, concern letters, any communication by immigration authorities, copy of visa and any other information requested by AO;</p>
<p>Further, it shall also be the obligation of AP that he shall be fully responsible for all acts of AP&rsquo;s sub-agents, authorized persons, franchisees, employees and that they act and conduct themselves genuinely and as per the terms and conditions of this agreement;</p>
<p>Further, it shall also be the duty of AP to support AO&rsquo;s employees, team members, directors or any other representative, to finalize client registrations for the Program/Course;</p>
<p>Further it shall also be the duty of the AP to immediately forward to AO any communication or other requests received by AP from client relating to the AO Services.</p>
<p>&nbsp;</p>
<ol start="5">
<li><strong>Change of agent</strong>:-</li>
</ol>
<p>AP herein agrees that if a client intends to use a different AP in place of existing or initial AP, in that eventuality AO reserves the right to replace an AP;</p>
<p>Further, if a client intends to use another AP in place of existing AP, the AP should follow the policy and procedures provided by AO for change of AP;</p>
<p>Further if a client submit AP change form or directly requests at any time to AO before the deposit of tuition fee having been received by the PI in United Kingdom, submission of GTE documents received by PI in Australia and submission of visa application with Immigration New Zealand in New Zealand the AO shall be free to change such AP;</p>
<p>Further, the complete policy and procedure that a client or AO Partner must follow for change of AP can be found at www.admitoffer.com and such policy and procedures may be updated by AO at any time. In the process if necessitated the AO may contact each Client directly or with AP&rsquo;s assistance to confirm a change of AP.</p>
<ol start="6">
<li><strong>Use of name, logo or other information:-</strong></li>
</ol>
<p>&nbsp;</p>
<p>The AP agrees that AP is authorized only to represent AO under this Agreement and not any of PI&rsquo;s to which Clients may apply through the AO Services, and therefore must not use the name, logo or other information of PI&rsquo;s while using Admit Offer Services.</p>
<ol start="7">
<li><strong> Commission for AO Services:- </strong></li>
All applications for AO Services submitted by AP on behalf of a Client will be subject to sole discretion of AO. AO reserves the right to accept or reject any application.
The charges and other terms of the AO Services will be determined solely by AO.
<li style="margin-top:10px;padding-top:10px;"><strong>AP&rsquo;s covenants, represents and warrants:</strong>-</li>
</ol>
<p>That AP has the full power to enter into this Agreement and to perform AP&rsquo;s obligations hereunder;</p>
<p>That the AP has acquired necessary licenses, registration and permissions to perform the Admit Offer Services;</p>
<p>That the AP will work in compliance with all its obligations and binding requirements of this agreement;</p>
<p>That the AP will conduct the business activities and recruit clients in an ethical manner and will not do any actions that can harm the reputation of AO or the Admit Offer Services;</p>
<p>That the AP will not make any guarantees to clients about whether they will be granted a student visa;</p>
<p>That the AP will not engage in false or misleading advertisements or statements;</p>
<p>That the AP will not make any false representations, warranties or guarantees about AO, the AO Services, or any PI&rsquo;s available through the AO Services;</p>
<p>That the AP will not use marketing and informational material unless provided by or approved by AO;</p>
<p>That the AP will, at all times, charge Clients a reasonable fee for the services provided by AP;</p>
<p>That the AP will not disclose the Confidential information or personal information of any Client to any third party;</p>
<p>That the AP will respond to any information request by AOand furnish documents if applicable;</p>
<p>That the AP will not provide any immigration advice to clients unless the AP is meeting the applicable compliance of the country the client is recruited to;</p>
<p>That the AP will provide such immigration advice to clients only if the AP is having the required registration/License applicable in the country of AP;</p>
<p>That the AP will not charge any fees if not permitted by the applicable law.</p>
<ol start="9">
<li><strong>Suspension and Termination of agreement or Services:-</strong></li>
</ol>
<p>If at any point of time AO becomes aware that AP has failed to comply with any of AP&rsquo;s duties or obligations in this Agreement, including if AO becomes aware that AP, an individual counsellor employed by AP, sub-agent, franchisee, family member, branch office of AP has committed any breach of this Agreement, then the AO reserves the right to either suspend AP&rsquo;s ability to use the Admit Offer Services and AOTech or the AO may put AP on probation, for a period determined by AO;</p>
<p>Further, if AP is suspended or this Agreement is terminated, for whatever reason, AO reserves the right, without limiting its other rights and remedies, to directly contact any of AP&rsquo;s Clients;</p>
<p>Further, if AP is suspended or this Agreement is terminated, for whatever reason, AO reserves the right, without limiting its other rights and remedies, to notify PI&rsquo;s and publish a notice regarding AP&rsquo;s suspension or termination. AP will not be entitled to any Commission for any Client who is not, at the time, enrolled with a PI;</p>
<p>Further the AO may suspend or terminate AP&rsquo;s use of the Admit Offer Technology if AP does not use the Admit Offer Technology on a regular basis. AO can also suspend or terminate Admit Offer Technology of AP if AO believes that AP is using or misusing Admit Offer Technology for the sole purpose of program shortlisting and is not recruiting any clients on Admit Offer Technology intentionally;</p>
<p>Further, if a AP is suspended for non-use of the Admit Offer Technology or commits a breach of this Agreement or other Event of Default, any Clients listed under a AP&rsquo;s profile will revert back to the common pool within the Admit Offer Technology, and if any Client applies through another AP or directly to AO, in addition to AP, such Clients will be removed from AP&rsquo;s dashboard of Admit Offer Technology;</p>
<p>Further, during a period of suspension, AP cannot apply for new Clients;</p>
<p>Further, during a period of suspension, AP cannot apply for new Programs for existing Clients however AP can access all existing Clients of AP and can communicate with AO for such Clients. A suspension does not mean AP&rsquo;s account has been terminated. If suspended AP should contact AP&rsquo;s Relationship Manager directly or via e-mail at partners@admitoffer.com.</p>
<ol start="10">
<li><strong> AO Obligations:-</strong></li>
</ol>
<p>During the subsistence of this agreement AO will provide AP with AO Team, Services, information, sales and other assistance as may reasonably be necessary for AP to perform the Admit Offer Services;</p>
<p>Further, from time to time, AO may provide written or electronic materials to AP to aid in the performance of the Admit Offer Services. AP will use such materials only for the purpose of providing the Admit Offer Services and specifically for the purposes specified by AO in relation to such materials, and will not misuse such materials, including to represent the Admit Offer Services inaccurately or to provide to any competitor or unauthorized person of AO.</p>
<ol start="11"><br>
<li><strong>AP Commission:-</strong></li>
</ol>
<p>Subject to AP&rsquo;s compliance with the terms of this Agreement, and in consideration for AP&rsquo;s provision of the Admit Offer Services, AO will pay a commission for any Client that AP successfully recruits, based on the estimated commission shown on AO Team or on the AO website being a percentage of the commission that AO receives from the PI. AP acknowledges that the actual Commission paid could be different as shown on the dashboard due to Data error;</p>
<p>Further, the AP will receive the Commission within 4 weeks after AO receives the funds from the PI when the Client has landed in either UK, Australia &amp; NZ;</p>
<p>Further, if the commission is not received by the AO because of any of the following reasons then the AO will not be liable to pay the commission to AP:-</p>
<ol>
<li>if the Client has not enrolled itself with the PI after getting visa and landing in the respective country;</li>
<li>if the client has not attended the minimum number of classes as required by the PI;</li>
<li>if the client withdraws from the program and does not begin studies for any reason;</li>
<li>if the client is not granted the study permit by the competent authority;</li>
<li>if the client does not pay his or her tuition fee; or</li>
<li>if the PI shuts its operations due to any reasons such as but not limited to Bankruptcy, Natural calamity or disaster, cancellation of registration/license, epidemic etc.</li>
</ol>
<p>Further, if at any point of time the client leaves the course and the PI is required to refund the tuition fees and the AO has to refund the commission to PI for any reasons then AP will have to refund the commission paid to him. The amount of refund can also be adjusted in other payments to be made by AO to AP;</p>
<p>Further, it is clarified that the actual amount of a refund paid by an PI is not controlled by AO and is subject to each of the PI&rsquo;s policies;</p>
<p>Further, if more than one AP makes a claim for a Commission for the same Client, payment of the Commission will be made to AP that has submitted a tuition receipt on behalf of the Client initially;</p>
<p>Further, the AP will not receive Commission for Clients who will become Permanent Resident, citizens, or conditional permanent residents, or who hold other eligible non-citizen immigration visas making them eligible as domestic clients for purpose of Tuition fee payment. and if fraudulent documents are submitted to AO, immigration authorities, PI&rsquo;s or any other related organization &nbsp;on behalf of a Client or if an AP provides fraudulent advice to a Client;</p>
<p>Further, in case of any dispute regarding payment of commission to an AP, the decision of the AO shall be final and binding.&nbsp;</p>
<ol start="12"><br>
<li><strong>AP Expenses</strong>:-</li>
</ol>
<p>AP will be solely responsible for all expenses incurred as a direct or indirect result of the performance of the Admit Offer Services, including rents, salaries, expenses for advertising, promotional activities, travelling to roadshows, and meeting Clients.</p>
<p>Further, AP will pay all applicable taxes including, but not limited to taxes such as GST, Income Tax etc on its own independently.</p>
<ol start="13"><br>
<li><strong>Invoice to receive Commission:-</strong></li>
</ol>
<p>AP will create an AO invoice and provide information as requested by AO. AP must use the invoice template provided by AO to generate invoice.</p>
<ol start="14"><br>
<li><strong>AO&rsquo;s assistance &amp; monitoring:-</strong></li>
</ol>
<p>That AO will provide AP with sufficient hard and soft marketing material regarding the PI&rsquo;s and their Programs to assist AP to run the Admit Offer Services;</p>
<p>Further, AO will duly process all completed applications received (but is under no obligation to accept any Clients referred by AP); and</p>
<p>Further, AO will regularly monitor the activities of AP, perform regular meetings, correspond ask for reports detailing Client enrolment processes, progress and outcomes, in addition to asking information regarding AP&rsquo;s activities via Client and parent feedback.</p>
<ol start="15">
<li><strong> Confidential Information:-</strong></li>
</ol>
<p>That during the term of this agreement and also in the event of renewal, suspension, termination or expiry of agreement AP is liable not to copy, disclose, transfer, divulge, provide, mirror, scrape, use robots, reproduce any information regarding Admit Offer Services to a third party;</p>
<p>Further, AP on demand of AO will immediately return to all Confidential Information which is in AP&rsquo;s possession;</p>
<p>Further, if any breach is made by the AP then AO will be entitled to seek appropriate injunction from the competent court for enforcement of the AP&rsquo;s obligations;</p>
<p>Further, AP at any stage has to disclose any information then the same can only be to the extent that is required by law to do&nbsp; and in such an event the AP will notify the AO so that the AO may seek necessary orders for limiting or precluding such disclosure.</p>
<ol start="16">
<li><strong> Restraint from Solicitation and Competition:-</strong></li>
</ol>
<p>That during the Term and for a period of one year after the termination or expiry of this Agreement, the AP will not enroll or solicit clients for the PI&rsquo;s which are on the Admit Offer services and Admit Offer Technology;</p>
<p>Further, the AP will not employ any employee of AO or enter in an agreement with AO&rsquo;s current or former employee to recruit for any PI;</p>
<p>Further, the AP shall not directly compete with AO during the subsistence of this agreement or one year after the expiry or termination of this agreement;</p>
<p>Further, AP acknowledges that on breach of this Section the AO can seek injunction from the competent court or authority.</p>
<ol start="17"><br>
<li><strong> Intellectual Property:-</strong></li>
</ol>
<p>That AP acknowledges that they do not acquire any intellectual property or other proprietary rights under this Agreement, including any right, title or interest in and to patents, copyrights, trademarks, industrial designs, confidential information, or trade secrets, whether registered or unregistered, relating to the Admit Offer Services or Admit Offer Technology;</p>
<p>Further, AP must not copy any kind of content from Admit Offer Technology for Creating a competing website, technology or service.</p>
<ol start="18"><br>
<li><strong> Term of agreement:-</strong></li>
</ol>
<p>That the term of this Agreement will be for ____ years/months and can be renewed with consent of both parties.</p>
<br><ol start="19"><br>
<li><strong> Early termination of agreement:-</strong></li>
</ol>
<p>That this agreement may be terminated by either Party for any reason with a 30 days written notice by email or post;</p>
<p>Further, AO can investigate actions of AP in case of any kind of breach such as misleading advertisements, submission of fake documents, overcharging of professional fee and if on investigation it is found that AP has committed any of the above breach the agreement can be terminated by AO forthwith;</p>
<p>Further, AO can immediately terminate this agreement if AP commits a breach of any terms and conditions of this Agreement and does not adhere or comply by any direction from AO to rectify the breach.</p>
<ol start="20"><br>
<li><strong> Consequences on Termination or Expiry:-</strong></li>
</ol>
<p>That upon termination or expiry of this Agreement, AP must immediately cease holding itself out as authorized to recruit on behalf of AO immediately and cease to provide Admit Offer Services for AO.</p>
<ol start="21"><br>
<li><strong> Disclaimer:-</strong></li>
</ol>
<p>That AP will be solely responsible for all of the Admit Offer Services and activities undertaken under this Agreement. AO expressly disclaims all liability for any claims, losses or damages arising out of such Admit Offer Services and activities, including any claims, losses or damages relating to false representations made by AP to Clients or other third parties;</p>
<p>Further, the Admit Offer Technology and the Data are provided &ldquo;as is&rdquo; without warranty or condition of any kind;</p>
<p>Further, use of the Admit Offer Technology or the Data is at AP&rsquo;s own risk. The Admit Offer Technology and the Data may include errors, omissions and inaccuracies, including pricing errors. AO does not assume any responsibility for these errors, omissions or inaccuracies. In addition, AO reserves the right to correct any pricing errors on the Admit Offer Technology. AO makes no guarantees about the availability of specific services.</p>
<ol start="22"><br>
<li><strong>Set-off and Indemnities:-</strong></li>
</ol>
<p>That AP shall defend, indemnify and hold harmless AO and all of its officers, directors, employees and agents from and against any claims, causes of action, demands, recoveries, losses, damages, fines, penalties or other costs or expenses of any kind or nature including reasonable legal and accounting fees for the losses suffered by AO on the breach of any of the AP&rsquo;s declarations, covenants, warrants, representations, duties or obligations under these Terms and Conditions, including AP&rsquo;s violation of any Applicable Law;</p>
<p>Further, the AP shall indemnify AO for any loss suffered by AO for any act or action of AP infringing, misappropriating or violating of the rights of a third party, including any intellectual property rights;</p>
<p>Further, the AP shall also indemnify AO for any losses suffered by AO due to wrongful or unauthorized use of the Admit Offer Technology or the Data by AP;</p>
<p>Further, the AP shall also indemnify AO for any losses suffered by it due to some conduct, act or omission committed by the AP for which AP was never granted permission by AO or was beyond the terms of this agreement, and this shall also include any conduct, act or omission committed by AP the scope of which has not been defined in this agreement but still the AO suffers any kind of loss;</p>
<p>Further, AO can set off or adjust any pending invoices of the AP for the losses suffered by AO due to the above reasons explained.</p>
<ol start="23"><br>
<li><strong>Limit of Liability</strong></li>
</ol>
<p>AO will not be liable at any stage for any loss suffered by the AP due to any reason not set out in this agreement or for any loss due to any use of or inability to use AO Tech or Data;</p>
<p>Further the AO will not be liable for any fines, fees, penalties or other liabilities the AP may suffer during the use of the AO tech or AO Services.</p>
<p>&nbsp;</p>
<ol start="24"><br>
<li><strong> Other General terms and Conditions:- </strong></li>
</ol>
<p>AP agrees that it will not upload to or transmit through the AO Technology any content or submission that is offensive, seditious hateful, obscene, defamatory or violates any applicable laws;</p>
<p>Further, The AO Technology may provide links to third party websites, including to those of PI&rsquo;s. AO does not endorse the information contained on those web sites;</p>
<p>Further, the downloading and viewing of Data is done at AP&rsquo;s own risk. AO cannot guarantee that the AO Tech or the Content, or any links from the AO Tech or the Content, will be free of viruses;</p>
<p>Further, neither of the Party will be liable for delays caused by any event beyond its reasonable control, except non-payment of amounts due under this Agreement will not be excused by this provision;</p>
<p>Further, any notices, reports or other communications required or permitted to be given under this Agreement will be in writing, including email, and will be sufficient if delivered by hand or sent by registered mail, courier or facsimile addressed to AP or AO at their respective addresses as advised in writing. Any such notices, reports, or other communications will be deemed to have been received by the Party to whom they were addressed;</p>
<p>Further, the AP will be primarily responsible for the performance of all of AP&rsquo;s obligations in this Agreement including its subagents if any. The AO will not be responsible for any wrongful act of the AP&rsquo;s sub agent.</p>
<p><strong>&nbsp;</strong></p><br>
<ol start="25" style="margin-top:40px;">
<li><strong> Jurisdiction and dispute resolution:-</strong></li>
</ol>
<p>That in case of any dispute between the parties the jurisdiction of Ontario, Canada will be applicable and the same shall be subject to the courts situated at Ontario, Canada.</p>
<p>&nbsp;</p>
<p>I, '.$agent['name'].' (AP) acknowledge that I have read and agree to the above Terms and Conditions. I acknowledge that I am authorized to sign this Agreement.</p>
<p>&nbsp;</p>
<ol>
<p>&nbsp;</p>
<p style="text-transform:uppercase">For ADMIT OFFER TECHNOLOGIES INC. (AO)</p>
<p>&nbsp;</p>

<li>__________________________</li>
</ol>
<p>&nbsp;</p>
&nbsp;<p style="text-transform:uppercase;">&nbsp;&nbsp; &nbsp;For '.$agent['company_name'].' (AP)</p>
<p>&nbsp;</p>

<ol start="2">
<li>___________________________</li>
</ol>

            ');
        return $pdf->stream();
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($this->redirectTo);
    }

}