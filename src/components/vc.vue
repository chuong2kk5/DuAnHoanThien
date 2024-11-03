<!-- javascript -->
<script setup>

import { ref } from 'vue';
let avatar = ref('https://khoinguonsangtao.vn/wp-content/uploads/2022/08/hinh-anh-avatar-sadboiz-deo-head-phone.jpg');
let name = ref('Philadelphia');
let address = ref('4670 Garrett Street');
let phone = ref('Tel 267-981-2091');
let languege =ref('US')

const changeAvatar = () => {
    let newAvatar = prompt('edit avatar');
    if (newAvatar != null) {
        avatar.value = newAvatar
    }
}

const changeName = () => {
    let newName = prompt('edit name');
    if(newName != null){
        name.value = newName
    }
}
const changeAddress = () => {
    let newAdress = prompt('edit address');
    if(newAdress != null){
        address.value = newAdress
    }
}
const changePhone = () => {
    let newPhone = prompt('edit phone');
    if(newPhone != null){
        phone.value = newPhone
    }
}

const changeLanguege = () => {
    let newLanguege = prompt('edit languege');
    if(newLanguege != null){
        languege.value = newLanguege
    }
}
</script>


<!-- run html -->
<template>
<div class="container">
    <br>
    <br>
    
    <div class="card">
        <div class="card-body">
           <div class="row">
            <article class="col-sm-4">
            <div class="image">
                <img @click="changeAvatar" :src="avatar" class="card-img-top" alt="avatar">
            </div>
            <br>
            <div class="msg">
                <ul>
                <li class="text-user" @click="changeAddress">{{ address }}</li>
                <li class="text-user" @click="changeName">{{name}}</li>
                <li class="text-user" @click="changeLanguege">{{languege}}</li>
                <br>
                <li class="text-user" @click="changePhone">{{phone}}</li>
                <a href=""><li class="text-user"><a href="jason@develolier.com">jason@develolier.com</a></li></a>
                <a href=""><li class="text-user"><a href="www.JasonMBou.com">www.JasonMBou.com</a></li>  </a>
               <a href=""> <li class="text-user"><span style="font-size: 16px; font-weight: bold; color: #0077b5; margin-right: 5px;">S</span>
                LinkedIn JasonMBou</li></a>
               <a href=""><li class="text-user"><i class="bi bi-linkedin"></i> LinkedIn JasonMBou </li></a> 
                <a href=""><li class="text-user"><i class="bi bi-facebook"></i> Facebook JasonMBou</li></a>
               <a href=""><li class="text-user"><i class="bi bi-twitter"></i> Twitter JasonMBou </li></a> 
               <a href=""> <li class="text-user"><i class="bi bi-instagram"></i> Instagram JasonMBou</li></a>
                </ul>
                <br>
                <hr>
                <br>
                <h5>Project Management</h5>
                <ul>
                    <a href=""><li class="text-user">Jira</li></a>
                    <a href=""><li class="text-user">Slack</li></a>
                  <a href=""><li class="text-user">Trello</li></a>  
                </ul>
                <br>
                <hr>
                <br>
                <h5>Design & Coding</h5>
                <ul>
                   <a href="#"><li class="text-user">HTML, CSS</li></a> 
                   <a href="#"><li class="text-user">JavaScript, jQuery</li></a> 
                    <a href="#"><li class="text-user">Front End frameworks (Angular, Ember, React)</li></a>
                    <a href="#"><li class="text-user">Responsive UI Design</li></a>
                  <a href="#"> <li class="text-user">WordPress</li></a> 
                   <a href="#"><li class="text-user">Adobe Photoshop</li></a> 
                  <a href="#"> <li class="text-user">Visual Studio </li></a> 
                </ul>
            </div>
            </article>
            <aside class="col-sm-8" style="background-color: #fff;">
                <h1 class="title" style="font-weight: 600; letter-spacing: 1.5px;">Jason M.Bourassa</h1>
                <h6 style="font-weight: 400; font-size: 1.5rem; letter-spacing: 1.5px;">Front End Developer With a keen eye for design</h6>
                <h5>Profile</h5>
                <p>Seasoned and independent Font End Developer with 5 years of experience in blending the art of design with skill 
                    of propramming to deliver an immersive and engaging use expenriece through efficient web development. proactive 
                    feature optimization and relentlenless.
                </p>
                <br>
                <p>
                    Very passionnate about aesthetics UL design.</p>
                <h5>Experience</h5>
                <p>
                    <strong> Front End Developer / Henser Ltd.</strong>
                    Sep 2017 - currently employed
                    Philadelphia, PA
                </p>
                <ul>
                    <li>Deliver engaging user experience through optimization
                         of images, code, and cross-browser compatibility, increasing 
                         Time on Page by +60 seconds for +60 websites.
                    </li>
                    <li>
                        Expand features, refine code, and improve processes, producing
                         smoother operations and enhancing user engagement.
                    </li>
                    <li>
                        Designed dynamic and browser-compatible pages using HTML5, CSS3, jQuery, and JavaScript.
                    </li>
                    <li>
                        Built single-page applications (SPA), responsive web design, UI 
                        using HTML5 grid layouts, CSS3 media queries where its an 
                        expression and can be used to either true or false.
                    </li>
                    <li>
                        Ensure efficient web development by supporting
                      designers and app developers while resolving website performance issues.
                    </li>
                </ul>
                <p>
                    <strong>Front End Developer / Henser Ltd.</strong>
                    Sep 2014 - Aug 2017
                    Philadelphia, PA 
                </p>
                <ul>
                    <li>
                        Delivered responsive, cross-browser compatible, and accessibility compliant
                         websites, achieving 19% faster load time than industry average.
                    </li>
                    <li>
                        Produced stunning visual elements of web applications by translating 
                        UI/UX design wireframes into code while producing high quality, reusable markup 
                        using HTML5 and CSS3.
                    </li>
                    <li>
                        Designing frontend within object-oriented JavaScript frameworks like Angular.Js and Ext.Js.
                    </li>
                </ul>
                <hr>
                <h5>Education</h5>
                <p>
                    <strong>Associate in Computer Science / Saint Maria University</strong>
                    Sep 2011 - Jul 2014
                </p>
                <ul>
                    <li>Graduated with the highest academy remarks.</li>
                </ul>
            </aside>
           </div>
        </div>
    </div>
</div>
    

</template>

<!-- css -->
<style>
.container{
    background-color:rgb(154, 177, 174) ;
    height: 1250px;
    font-family: Arial, Helvetica, sans-serif;
    
}

.container .card{
    border: none !important;
    
}
.container img{
    width: 200px;
    height: 200px;
}
.container .msg p{
    margin-bottom: 0 !important;
}
.container ul li{
    font-size: 16px;
}

.container ul li.text-user{
    list-style: none;
    color: #111;
    margin-bottom: 5px;
}
.container ul li.text-user:hover{
    color: red;
}

.container ul a{
    text-decoration: none;
}
article,
aside {
  padding: 20px;
}

.container h5{
    color: #111;
    font-weight: 600;
    font-size: 1.5rem;
}
.container .card-body{
    background-color:rgb(154, 177, 174) ;
}
</style>