/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * CMS APP CUSTOM PLUGIN
 * -----------------------
 * This plugin depends on iCheck plugin for checkbox and radio inputs
 *
 * @type plugin
 * @usage $("#todo-widget").todolist( options );
 */
(function ($) {

  'use strict';
  
  $('.check_all').click(function(){ 
      $('input:checkbox.check_id').not(this).prop('checked', this.checked);
      
  });
  
  $('.page-limit').change(function(){
      $('.form-data-list').submit(); return true;
  });
  
  $('.filter-btn').click(function(e){
       e.preventDefault();
       var status = $('.filter-status').val(); 
       var url = $('.form-filter').attr('action'); 
       window.location.href=url+'/'+status;
       return true;
  });
  $('.apply-btn').click(function(e){
     e.preventDefault();
     var url = $('.form-bulk-action').attr('action'); 
     
      if($('input:checkbox.check_id:checked').length > 0){
          
          var IDs = $("input:checkbox.check_id:checked").map(function(){
            return $(this).val();
          }).get(); 
          $('#ids').val(IDs);
          $('.form-bulk-action').prop('action',url+'/update').submit();
      }
      else{
          $('.form-bulk-action').prop('action',url+'/update').submit();
          return true;
          alert('Please selete one!')
      }
  });
  
  $.getUrlVars = function getUrlVars()
  {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
       // console.log(hash);
        vars.push(hash);
        vars[hash[0]] = hash[1];
    }
    return vars;
  };
 }(jQuery));