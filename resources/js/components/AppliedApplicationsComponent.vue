<template>
<div>
    <div class="card-header">
        <div class="col-md-7">Applied Students List</div>   <div class="col-md-4">
            <input type="text" class=" form-control bgColorGray" placeholder="Search By Student Name/ Program" v-model="search" >
                
        </div>
    </div>

    <div class="card-body row" >
        
        <div class="col-md-2">
            <input type="text" class="mb-2 form-control bgColorGray" placeholder="Application Id"  name="app_id" v-model="application_id" >
                
        </div>
        <div class="col-md-2">
            <input type="text" class="mb-2 form-control bgColorGray" placeholder="Student Id" v-model="student_id" >
                
        </div>
        <div class="col-md-2">
            <select class="mb-2 form-control bgColorGray"  name="agent_id" v-model="agent_id" >
                <option value=''> Select Agent</option>
                <option v-for="agent in agents" v-bind:value="agent.id" >{{agent.name}}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="mb-2 form-control bgColorGray"  name="intake"  v-model="intake_id">
                <option value=''> Select Intake</option>
                <option v-for="intake in intakes" v-bind:value="intake.id" >{{intake.name}}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="mb-2 form-control bgColorGray"  name="institute" v-model="institute_id">
                <option value=''> Select Institute</option>
                <option v-for="college in colleges" v-bind:value="college.id" >{{college.name}}</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="mb-2 form-control bgColorGray"  name="status"  v-model="applicationStatuse_id">
                <option value=''> Select Status</option>
                <option v-for="applicationStatus in applicationStatuses" v-bind:value="applicationStatus.id" >{{applicationStatus.name}}</option>
            </select>
        </div>

        <div>

        </div>
            <table class="mb-0 table table-bordered tableID">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="text-center">Agent</th> 
                        <th>Student Id</th>
                        <th>Student Name</th>
                        <th>Program</th>
                        <th>Institute</th>
                        <th>Intake</th>
                        <th>Status</th>
                        <!-- <th>Agent Commission</th>
                        <th>Total Commission</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="appendQualTest ">
                    <tr v-for="application in filterApplications">
                        <th scope="row">{{application.id}}</th>
                        <td class="capitalize text-center">{{application.agent.name}}<br>
                            <small>{{application.agent.company_name}}</small><br>
                            <small>{{application.agent.mobileno}}</small><br>
                            <small>{{application.agent.email}}</small>
                        </td>
                        <td ><span class="badge badge-warning badge-pill" v-if="application.student">{{application.student.student_unique_id}}</span></td>
                        <td class="capitalize" v-if="application.student">{{application.student.firstName}} &nbsp;{{application.student.lastName}}</td>
                        <td class="capitalize" v-if="!application.student">-</td>
                        <td class="capitalize">{{application.course.name}}</td>
                         <td class="capitalize"><img :src="'/'+application.country.path+''+application.country.image_name" class="width-20-height-20"> {{application.course.college.name}}</td>
                         <td class="capitalize" v-if="application.course.intakes">{{application.course.intakes.name}}</td>
                         <td class="capitalize" v-if="!application.course.intakes">-</td>
                         <td class="capitalize badge-warning  " v-if="application.application_status.name == 'Fresher'">{{application.application_status.name}}</td>
                         <td class="capitalize badge-success " v-if="application.application_status.name != 'Fresher'">{{application.application_status.name}}</td>
                         <!-- <td class="capitalize ">${{application.course.agent_commission}}</td>
                         <td class="capitalize">${{application.course.total_commission}}</td> -->

                        <td><a href="javascript:;" v-on:click="spplicationShow(application.id)" class="btn btn-warning minus" data-id type="button"  > <i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                        
                    </tr>
                   
                </tbody>
            </table>
    </div>
    </div>
</template>

<script>
    export default {

        
        data(){
            return {
               appliedStudentFiles:{},
               file_status:'',
               agents:'',
               agent_id:'',
               intakes:'',
               intake_id:'',
               colleges:'',
               institute_id:'',
               applicationStatuses:'',
               applicationStatuse_id:'',
               application_id:'',
               student_id:'',
               studentCheck:false,
               search:'',
            }
        },
        created(){
            this.allApplications();
           
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods:{

        
            allApplications(){
                    // document.getElementByName("colleges_id").checked = true;
                    axios.get('/admin/getAllApplications' ).then(response => {
                        console.log(response);
                        this.appliedStudentFiles = response.data.appliedStudentFile;
                        this.agents = response.data.agents;
                        this.intakes = response.data.intakes;
                        this.colleges = response.data.colleges;
                        this.applicationStatuses = response.data.applicationStatus;
                        console.log(this.appliedStudentFiles);
                       
                    }).catch(error => {
                        if (error.response.status === 422) {
                        this.updateErrors = error.response.data.errors || {};
                        }
                    });
               
            },
            spplicationShow(id){
                let encodeId = btoa(id);
                window.location.href = 'application/'+encodeId;
            }

        },
        computed:{
             filterApplications:function(event){
                return this.appliedStudentFiles.filter((application)=>{
                    if(this.search){
                        console.log(application.student.firstName);
                        return  String(application.student.firstName.toUpperCase()).match(String(this.search.toUpperCase()))  || String(application.course.name.toUpperCase()).match(String(this.search.toUpperCase()));
                    }
                    
                    if(!application.student && !this.student_id ){
                        this.studentCheck =true; //alert('00'+ course.intake);
                    }else if(!application.student && this.student_id){
                        this.studentCheck =false;
                    }else{
                        this.studentCheck = String(application.student.student_unique_id).match(String(this.student_id.toUpperCase()));
                    }
                   
                    if(this.student_id ){
                        if(application.student){
                            return  String(application.file_status).match(String(this.applicationStatuse_id)) && String(application.course.college.id).match(String(this.institute_id)) && String(application.agent_id).match(String(this.agent_id))  && String(application.course.intake).match(String(this.intake_id)) && String(application.id).match(String(this.application_id)) && this.studentCheck;//course.name.toLowerCase().match(this.search.toLowerCase()) && application.qualification.match(this.qualifications_id) && String(course.subject).match(this.subjects_id) && this.courseCheck && course.english_score.match(this.englishScore_id) && this.ilets_score_check && this.programCheck &&  this.collegesCheck && this.mathScore_check && this.stateCheck && this.instituteTypeCheck && this.schoolTypeCheck && this.intakeCheck && this.tution_fee_check && this.applicationFeeCheck && this.programDeliveryCheck && this.scholarshipCheck;
                        }else{
                            return  String(application.file_status).match(String(this.applicationStatuse_id)) && String(application.course.college.id).match(String(this.institute_id)) && String(application.agent_id).match(String(this.agent_id))  && String(application.course.intake).match(String(this.intake_id)) && String(application.id).match(String(this.application_id));//course.name.toLowerCase().match(this.search.toLowerCase()) && application.qualification.match(this.qualifications_id) && String(course.subject).match(this.subjects_id) && this.courseCheck && course.english_score.match(this.englishScore_id) && this.ilets_score_check && this.programCheck &&  this.collegesCheck && this.mathScore_check && this.stateCheck && this.instituteTypeCheck && this.schoolTypeCheck && this.intakeCheck && this.tution_fee_check && this.applicationFeeCheck && this.programDeliveryCheck && this.scholarshipCheck;

                        }
                    }else{
                            return  String(application.file_status).match(String(this.applicationStatuse_id)) && String(application.course.college.id).match(String(this.institute_id)) && String(application.agent_id).match(String(this.agent_id))  && String(application.course.intake).match(String(this.intake_id)) && String(application.id).match(String(this.application_id));//course.name.toLowerCase().match(this.search.toLowerCase()) && application.qualification.match(this.qualifications_id) && String(course.subject).match(this.subjects_id) && this.courseCheck && course.english_score.match(this.englishScore_id) && this.ilets_score_check && this.programCheck &&  this.collegesCheck && this.mathScore_check && this.stateCheck && this.instituteTypeCheck && this.schoolTypeCheck && this.intakeCheck && this.tution_fee_check && this.applicationFeeCheck && this.programDeliveryCheck && this.scholarshipCheck;

                    }
                 
                });
            },
            
            
        }
    }
</script>
