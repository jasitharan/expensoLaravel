document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)
    
    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
    toggle.addEventListener('click', ()=>{
    // show navbar
    nav.classList.toggle('show')
    // change icon
    toggle.classList.toggle('bx-x')
    // add padding to body
    bodypd.classList.toggle('body-pd')
    // add padding to header
    headerpd.classList.toggle('body-pd')
    })
    }
    }
    
    showNavbar('header-toggle','nav-bar','body-pd','header')
    
    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')
    
    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))
    
    // Your code to run since DOM is loaded and ready
    });
 
    
    
    function submitLogout() {   document.forms["signOutForm"].submit(); } 
    
    
    function sendNotification() { 
       
          document.forms["sendNotification"].submit(); 
        
        } 
        
        
    function saveSettingGlobal() { 
          document.forms["setting-global-form"].submit(); 
        } 
        
        function saveSettingMail() { 
          document.forms["setting-mail-form"].submit(); 
        } 
        
    function saveSettingNotification() { 
         document.forms["setting-notification-form"].submit(); 
    }       
    
    function createUser() {
       document.forms['users-create-form'].submit();
    }

    function editUser() {
      document.forms['users-edit-form'].submit();
    }
    
    function editExpense() {
      document.forms['expenses-edit-form'].submit();
   }
   
   
   function createExpenseType() {
    document.forms['expense_types-create-form'].submit();
 }
 
 function createCompany() {
  document.forms['companies-create-form'].submit();
}

function editCompany() {
  document.forms['companies-edit-form'].submit();
}
 

 
 function editExpenseType() {
  document.forms['expense_types-edit-form'].submit();
}

function createExpense() {
  document.forms['expenses-create-form'].submit();
}

function searchTable() {
  if (document.getElementById('search').value === '') {
    window.location.href = window.location.href.split('?')[0];
  } else {
    window.location.href = window.location.href.split('?')[0] + `?search=${document.getElementById('search').value}`;
  }
 
}

function submitEntries() {
  document.forms['show-entries-form'].submit();
}
 

function statusUpdate(formName) {
  document.forms[formName].submit();
}
  
 
 
 
 
 