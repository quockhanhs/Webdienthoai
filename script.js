function checkLength(){
	if(document.getElementById('input_Search').value.length > 6){
		alert('Bạn phải nhập lớn hơn 6 ký tự');
	}
	else{
		document.myform().submit();
	}
}