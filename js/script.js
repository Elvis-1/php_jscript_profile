function validate()
{
    console.log('validating');

    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var image = document.getElementById('image').value;

    var error =  document.getElementById('error').innerHTML;
    if(name == null || name == '' || email == null || email==''|| phone == null || phone =='' || image == null || image == '')
    {
        document.getElementById('error').innerHTML  = 'All fields are required';
         return false;
    }
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(!email.match(validRegex))
    {
        document.getElementById('error').innerHTML = 'Invalid email address';
        return false;
    }
    if(isNaN(phone))
    {
        document.getElementById('error').innerHTML = 'Invalid Number';
        return false;
    }
    isValidPhoto(image);
    return true;

   
}

function isValidPhoto(fileName)
{
    var allowed_extensions = new Array("jpg","png");
    var file_extension = fileName.split('.').pop().toLowerCase(); 

    for(var i = 0; i <= allowed_extensions.length; i++)
    {
        if(allowed_extensions[i] == file_extension)
        {
            return true; // valid file extension
        }
    }
    document.getElementById('error').innerHTML = 'Invalid image extension';
    return false;
  
}