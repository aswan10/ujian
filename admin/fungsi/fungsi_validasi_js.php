				<script type="text/JavaScript">
					function formValidator() {
						var KUNCI = document.getElementById('Kunci_jawaban');
						// Check each input in the order that it appears in the form!
						if(notEmpty(KUNCI, "Isi Kunci Jawaban"))
						{
						if(isAlphabet(KUNCI, "Kunci Jawaban harus Alphabet A-E "))
						{
						if(lengthRestriction(KUNCI, 1,1))
						{
							return true; // Masukan Valid
						}
						}
						}
						return false;
						} // end function Validator

						function notEmpty(elem, helperMsg)
						{
						if(elem.value.length == 0)
							{
							alert(helperMsg);
							elem.focus(); //set the focus to this input
							return false;
							}
							return true;
						} //end function notEmpty

						function isAlphabet(elem, helperMsg)
						{
						var alphaExp = /^[A-E]+$/;
						if(elem.value.match(alphaExp))
							{
							return true;
							}
							else
							{
							alert(helperMsg);
							elem.focus();
							return false;
							}
						} // end function isAlphabet

						function lengthRestriction(elem, min, max)
						{
						var uInput = elem.value;
						if(uInput.length >= min && uInput.length <= max)
							{
							return true;
							}
							else
							{
							alert("Please enter between "+min+" and "+max+" characters");
							elem.focus();
							return false;
							}
						} //end function lengthRestriction
					</script>