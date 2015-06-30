
<body style="width: 640px;margin: 0 auto;padding: 0;height: auto;font-family: verdana;">
    <div style="border: 15px solid #28BB7F;border-radius: 5px;">

        <div class="footer_details" style="background: none repeat scroll 0 0 #28bb7f;color: #fff;float: left;height: 35px;margin-bottom: 15px;text-align: center;width: 100%;">
            <div style="font-size: 14px;">
                <b>This is an auto-generated email. Please do not respond to it.</b>
            </div>
        </div>

        <div class="logo" style="width: 100%;text-align: center;height: 100px;padding: 20px 0 ;">
            <img src="{{ url('img/logo2.png') }}" />
        </div>
        <div class="upper_info">

            Hello, {{$user->first_name}} {{$user->last_name}}
            <br>
            You have successfully logged in.<br>

            Your Login details are here..<br>
            Login Email:{{$user->email}}<br>
            Login Password:{{$user->password1}}<br>
		    <h4>Thank you...!</h4>

        </div>



        <div class="footer_details" style="background: #28BB7F; color: #fff;">
            <div style="margin-left: 10px;padding: 30px 3px;font-size: 14px;">
                101/102, Shanti Mall<br>
                Nr. Satadhar X Roads<br>
                India, Gujarat<br>
                info@esparkinfo.com<br>
                Ahmedabad Gujarat 380061<br>
            </div>
        </div>

    </div>
</body>