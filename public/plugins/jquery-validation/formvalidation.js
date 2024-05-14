$(function () {
	$.validator.addMethod('nicChars', function (value, element) {
	  // Check if the value is empty
	  return this.optional(element) || /^\d{12}$/.test(value); // Check if the value contains exactly 12 digits
	});
//check 000 or then 9 digits or 19 or 20 with  10 digits
	$.validator.addMethod('nicFormat', function (value, element) {
		return /^(000\d{9}|1[9]\d{10}|2[0]\d{10})$/.test(value); 
	  });
	
	  //check phone No hAS 10 digits
	$.validator.addMethod('phoneIdigits', function (value, element) {
		return this.optional(element) || /^0\d{9}$/.test(value);
	  });
	//check whether all 12 digits are not repeating
	$.validator.addMethod('nicRepeat', function (value, element) {
		// Check if the value is empty
		if (this.optional(element)) {
			return true;
			}	
		// Check if all digits are not the same
		return !/(\d)\1{11}/.test(value);
	}, 'Please enter a valid NIC number.');

	//PDF Validation
	$.validator.addMethod('pdfOnly', function (value, element) {
		// Check if the value is empty
			if (this.optional(element)) {
				return true;
  			}

  		// Get the file extension
  		var extension = value.split('.').pop().toLowerCase();

  		// Check if the file has a '.pdf' extension
  		return extension === 'pdf';
		}, 'Please choose a PDF file.');

		//check whether maximum file size is 10MB or not
		$.validator.addMethod('pdfSize', function (value, element) {
			// Check if the value is empty
			if (this.optional(element)) {
				return true;
			}
		
			// Check file size (in bytes)
			var fileSize = element.files[0].size;
		
			// Check if the file size is below 10MB (10 * 1024 * 1024 bytes)
			return fileSize <= 10485760; // 10 MB in bytes
		}, 'Please choose a PDF file below 10MB.');
		
	//Check for letters with basic punctions
	$.validator.addMethod('letterswithbasicpunc', function (value, element) {
			return /^[A-Za-z.,'"\s]+$/.test(value);
		  }, 'Please enter a valid name');


	// Check if the length of the value is at least 3 characters
	$.validator.addMethod('charLength', function (value, element) {
		// Check if the value is empty
		if (this.optional(element)) {
			return true;
		}
		return value.length >= 3;
	}, 'Please enter at least 3 characters');
  
	// Initialize form validation on the frmchecknic form..........................................................
	$("#frmchecknic").validate({
	  rules: {
		// Specify validation rules
		// Uses the name attribute
		txtnic: {
		  required: true,
		  nicChars: true, // additional methods
		  nicRepeat: true,
		  nicFormat: true,
		},
	  },
	  // Specify validation error messages
	  messages: {
		txtnic: {
		  nicChars: "Please enter a valid NIC number",
		  required: "Please enter a NIC Number",
		  nicRepeat: "Please enter a valid NIC number",
		  nicFormat: "Please enter the NIC in correct format"
		},
	  },
/* 	  errorPlacement: function (error, element) {
		error.appendTo(element.next(".formerror"));
	  }, */
	  // Submit the form
	  submitHandler: function (form) {
		form.submit();
	  },
	});

		// Initialize form validation on the frmAddApp form..........................................................
	$("#frmAddApp").validate({
		rules: {
  
		  applicationno: "required",
		  patientnic: "required",
		  
		  patientname: {
			  required: true,
			  letterswithbasicpunc: true,
			  charLength: true
			},
			patientaddress1: "required",
			patientaddress2: "required",

			patientphone: {
				required: true,
				phoneIdigits: true
			  },

			diseaseid: "required",
			
			pdfpath: {
			  required: true,
			  pdfOnly: true,
			  pdfSize: true
			},
		},
		// Specify validation error messages
		messages: {
		  patientname: {
				letterswithbasicpunc: "Please enter a valid name",
				required: "Please enter Patient's Name",
				charLength: "Please enter at least 3 characters",
		  },
		  patientphone: {
			required: "Please enter a phone No",
			phoneIdigits: "Please enter a valid phone No.",
		  },
		  
		  pdfpath: {
			required: "Please Attach a File",
			pdfOnly: "Please choose a PDF File",
			pdfSize: "Please choose a PDF file below 10MB.",
			  
		},
		},
/* 		errorPlacement: function (error, element) {
			// Display the error message in the reserved space
			error.appendTo(element.next(".formerror"));
		  }, */
		// Submit the form
		submitHandler: function (form) {
		  form.submit();
		},
	  });

	  // Initialize form validation on the frmEachApp form..........................................................
	$("#frmEachApp").validate({
		rules: {  
			pdfpath2: {
			  required: true,
			  pdfOnly: true,
			  pdfSize: true
			  
			},
			pdfpath3: {
				required: true,
				pdfOnly: true,
				pdfSize: true
			  },
		},
		// Specify validation error messages
		messages: {
		  pdfpath2: {
			required: "Please Attach a File",
			pdfOnly: "Please choose a PDF File",
			pdfSize: "Please choose a PDF file below 10MB.",
			
		  },
		  pdfpath3: {
			required: "Please Attach a File",
			pdfOnly: "Please choose a PDF File",
			pdfSize: "Please choose a PDF file below 10MB.",
			  
		},
		},
/* 		errorPlacement: function (error, element) {
			// Display the error message in the reserved space
			error.appendTo(element.next(".formerror"));
		  }, */
		// Submit the form
		submitHandler: function (form) {
		  form.submit();
		},
	  });


	  $("#frmAddNewApp").validate({
		rules: {
  
			txtappnic: {
				required: true,
				nicChars: true, // additional methods
				nicRepeat: true,
				nicFormat: true,
			  },
		  
			txtappname: {
			  required: true,
			  letterswithbasicpunc: true,
			  charLength: true
			},

			// txtpnic: {
			// 	nicChars: true, // additional methods
			// 	nicRepeat: true,
			// 	nicFormat: true,
			//   },
		  
			// txtpname: {
			//   letterswithbasicpunc: true,
			//   charLength: true
			// },


			txtcity: "required",


			txtphone: {
				required: true,
				phoneIdigits: true
			  },

			diseaseid: "required",
			
		},
		// Specify validation error messages
		messages: {
			txtappname: {
				letterswithbasicpunc: "Please enter a valid name",
				required: "Please enter Applicant's Name",
				charLength: "Please enter at least 3 characters",
		  	},

		//   txtpname: {
		// 	letterswithbasicpunc: "Please enter a valid name",
		// 	charLength: "Please enter at least 3 characters",
	  	// 	}, 

			  txtappnic: {
				nicChars: "Please enter a valid NIC number",
				required: "Please enter a NIC Number",
				nicRepeat: "Please enter a valid NIC number",
				nicFormat: "Please enter the NIC in correct format"
			  },

			//   txtpnic: {
			// 	nicChars: "Please enter a valid NIC number",
			// 	nicRepeat: "Please enter a valid NIC number",
			// 	nicFormat: "Please enter the NIC in correct format"
			//   },

		  txtphone: {
			required: "Please enter a phone No",
			phoneIdigits: "Please enter a valid phone No.",
		  },
		  
		},
/* 		errorPlacement: function (error, element) {
			// Display the error message in the reserved space
			error.appendTo(element.next(".formerror"));
		  }, */
		// Submit the form
		submitHandler: function (form) {
		  form.submit();
		},
	  });
  });

  