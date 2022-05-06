<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/pagination.css');?>">
    <title>Students</title>
</head>
<style>
    *{
    font-family: 'Montserrat', sans-serif;
    color: #041159;
    }

    html{
        overflow: hidden;
    }

    .container-fluid{
        position:absolute;
        display:flex;
        margin-left: 20%;
        padding-top: 7%;
        width: 78%;
    }

    .disabled{
  pointer-events: none;
}
.table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > thead > tr > th {
    border: none;
}

.header{
    font-size: 1.2em;
}

.body{
    font-size: 1.1em;
}

tbody:before {
    content:"@";
    display:block;
    line-height:1em;
    text-indent:-99999px;
}

.pagination{
    position: relative;
    margin-left: 16vw;
}



.registration-header{
        font-weight: 800
    }

    .form-control{
        border-radius: 50px;
        width: 100%;
        padding: 1.5em;
    }

    .registration-button{
        background-color: #F27457;
        font-weight: 700;
        font-size: 1vw;
        border-radius: 25px;
        padding: 2%;
        padding-right: 7%;
        padding-left: 7%;
        color: #8C2E36;
        border: none;
    }

    .registration-button:hover{
      background-color: #1D28F2;
      color: #ffff;
    }

    .need-account{
        text-align: center;
    }
    .signin-link{
        color: #231773;
    }

    .login-container{
        padding-top: 5%;
    }


    
    .login{
    padding-top: 8%;
  }

  .email-button{
    padding-top:2%;
    padding-bottom:2%;
    padding-right:2%;
    padding-left:5%;
    border-radius: 50px;
    width:17vw;
  }

  .email-container{
    padding-bottom:1%
  }
</style>
<body>

    <div class="container-fluid">
    <div class="w-100 row">
    
    <div class="email-container">
      <form action="/Home/sendemail" method="POST">
    <button type="submit" class="button button btn btn-primary registration-button email-button">Email All Student Passwords</button>
    </form>
    <?php foreach($studmail as  $item) : ?>
   <?php
   $email = \Config\Services::email();
   $to =$item['email'];
           
   $subject = 'Faculty Evaluation';
   $message = 'Please Login using your credentials which is email<br>'
   . $item['email'].'<br>and your<br>'
   . $item['clear_text']. '<br>to access the faculty evaluation website';
   

   $email->setTo($to);
   $email->setFrom('johndoe@gmail.com', 'Philippine Public Safety College');
   
   $email->setSubject($subject);
   $email->setMessage($message);

   $email->send();

   ?>
    <?php endforeach; ?>
    </div>


  <div class="w-100"></div>
  <div class="w-100 row">
  <table class="table table-borderless">
  <thead>
    <tr>
      <th class="disabled header" scope="col">#</th>
      <th class="disabled header" scope="col">SCHOOL ID</th>
      <th class="disabled header" scope="col">FIRST NAME</th>
      <th class="disabled header" scope="col">LAST NAME</th>
      <th class="disabled header" scope="col">EMAIL</th>
      <th class="disabled header" scope="col">CLASS</th>
      <th class="disabled header" scope="col">PASSWORD</th>
      <th class="disabled header" scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
  <?php $x = 1;?>
  <?php foreach($student as  $item) : ?>
    <tr>
      <th class="disabled body" scope="row"><?php echo $x++;?> </th>
      <td class="disabled body"><?= $item['schoolid']?></td>
      <td class="disabled body"><?= $item['first_name']?></td>
      <td class="disabled body"><?= $item['last_name']?></td>
      <td class="disabled body"><?= $item['email']?></td>
      <td class="disabled body"><b><?= $item['course']?></b></td>
      <td class="disabled body"><?= $item['clear_text']?></td>
      <td>
      <a class="btn btn-light btn-outline-info" href="<?php echo base_url('Home/singleemailstudent/'. $item['id']);?>">Send Password</a>
      <a class="btn btn-light btn-outline-success" href="<?php echo base_url('Student/editstudent/'. $item['id']);?>">Edit</a>
      <a class="btn btn-light btn-outline-danger" href="<?php echo base_url('Student/deletestudent/'. $item['id']);?>">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
  <div class="w-100"></div>
  <div class="row ">
  <div class="d-flex justify-content-center flex-nowrap pagination fixed-bottom">
          <?= $pager->links() ?>
        </div>
</div>










    </div>
  
</body>
<script>
  setTimeout(function () {    
    alert("Passwords Have been Sent to all Students");
    window.location.href = '<?= base_url('Home/Student');?>'; 
},100); // 5 seconds
</script>
</html>