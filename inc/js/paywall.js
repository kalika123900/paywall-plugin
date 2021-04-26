function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
function tnPaywallFormSubmit()
{
 $('#paywallDonateEmail').trigger( "click" );
 return false;
}
jQuery(document).ready(function($){
  $('.btsite').click(function(){
  location.reload();
  });
  $('#paywallDonateEmail').click(function()
  {  var k = jQuery(this).closest('form');
    var c = jQuery(this).closest('.modal__content');
    var p = k.find('.pcd_email');
    var email = p.val();
    var errorstatus = false;
    var errormsg = '';
    if (email.length < 1 ) {
      errorstatus = true;
      errormsg = 'E-Mail is a required Field.';
    }
    if(!isValidEmailAddress(email)&& !errorstatus)
    {
        errorstatus = true;
        errormsg = 'Please enter a valid Email address.';
     } 
    if (errorstatus) {
        c.find('.errormsg').css('display','block').html(errormsg);
        k.find('.pcd_email').removeClass('valid').addClass('error');
		return false;
		
    }
    else
    { k.find('button').hide();
      k.find('img.loaderImg').show();
      if(k.find('.pcd_email').hasClass('error'))
      {
	  k.find('.pcd_email').removeClass('error');
	  }	  
      
var data = {
            'action': 'paywall_donate_email',
            'email': email
         };
    // We can also pass the url value separately from ajaxurl for front end AJAX implementations
    jQuery.post(ajax_object.ajax_url, data, function(response) {
            if(typeof response =='object')
            {
             if (response.status=='success') {
			  c.find('#primaryError').css('display','none');
              Paywall.hide();
			  Paywall.show('.three');
              }
             else if (response.status=='fail')
             {
                k.find('img.loaderImg').hide();	
                k.find('button').show();
                c.find('.errormsg').html(response.error);//code
                c.find('.errormsg').show();
			 }
            }
            else
            {
              if(response ===false)
              {
                 //the response was a string "false", parseJSON will convert it to boolean false
              }
              else
              {
                //the response was something else
              }
            }
    }, 'json');
    }
    });

});

/* Custom JS for Paywall */

var Paywall = {

  /* If the paywall container ever changes ID, just change it here */
  el: '#paywall',

  /* Currently unused, but may be of use depending on implementation. */
  init: function(callback) {
    callback;
  },

  /* Defines the 'step' element and contains a function to return the step type (modal or meerkat) */
  steps: {
    el: '.step',
    getType: function(el) {
      /* Checks to see if the step div has a class of modal or meerkat. */
      return $(el).hasClass('modal') ? 'modal' : 'meerkat'
    }
  },

  /* Defines the modal element and contains functions for showing and hiding modals */
  modal: {
    el: '.modal',
    show: function(step) {
      $(step).fadeIn(300);
      $('body').addClass('modal-open');
    },
    hide: function(step) {
      if (step) {
        /* If a step is passed, only hide that modal. */
        $(step).fadeOut(300);
        $('body').removeClass('modal-open');
      } else {
        /* Else hide all modals. */
        $(this.el).fadeOut(300);
        $('body').removeClass('modal-open');
      }
      
    }
  },

  /* Defines the meerkat element and contains functions for showing and hiding the meerkat. */
  meerkat: {
    el: '.meerkat',
    show: function(step) {
      if (step) {
        $(this.el + step).addClass('visible');
      }
    },
    hide: function(step) {
      if (step) {
        $(this.el + step).removeClass('visible');
      } else {
        $(this.el).removeClass('visible');
      }
    }
  },

  /* A global show function. Requires a step parameter. Will automatically fire the correct function based on the step. */
  show: function(step) {
    if (step) {
      var type = this.steps.getType(step);
      return type === 'modal' ? this.modal.show(step) : this.meerkat.show(step);
    }
  },

  /* A global hide function. Takes a step as a parameter or hides all. */
  hide: function(step) {
    if (step) {
      var type = this.steps.getType(step);
      return type === 'modal' ? this.modal.hide(step) : this.meerkat.hide(step);
    } else {
      this.util.hideAll();
    }
  },

  util: {
    /* Function for hiding all modals and meerkats. */
    hideAll: function() {
      Paywall.modal.hide();
      Paywall.meerkat.hide();
    }
  }
}

/* Functions for closing modal and redirecting and closing meerkat. */
jQuery(document).on('ready', function() {
  jQuery('.modal').on('click', '.modal__close', function(e) {
    document.location.href = '/';
  });
  jQuery('.meerkat').on('click', '.meerkat__close', function(e) {
    e.preventDefault();
    Paywall.meerkat.hide();
  })
});