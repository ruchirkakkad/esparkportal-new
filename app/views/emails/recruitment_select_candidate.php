<body style="width: 640px;margin: 0 auto;padding: 0;height: auto;font-family: georgia;">
<div style="height: 30px;"></div>
<div style="border: 15px solid #F77F38;border-radius: 5px;">

    <div class="footer_details" style="background: none repeat scroll 0 0 #F77F38;color: #fff;float: left;height: 35px;margin-bottom: 15px;text-align: center;width: 100%;">
        <div style="font-size: 16px;color: #fff;">
            <b>This is Interview call letter, Please confirm for the same...</b>
        </div>
    </div>

    <div class="logo" style="width: 100%;text-align: center;height: 100px;padding: 20px 0px ;">
        <img src="<?php echo url('img/logo2.png'); ?>" style="margin-top: 15px;"/>
    </div>

    <div class="upper_info" style="color: #006198;margin-top: 60px">
        <p style="margin-left: 10px;padding: 3px;font-size: 16px;"><b>Dear</b>  <b><?php echo $candidate->recruit_candidates_fname;?></b><br>Greetings for the day !!!</p>
        <p style="margin-left: 10px;padding: 3px;font-size: 16px;">Congratulations...<br>As discussed with you<br>You are <b>Selected</b> for the post of <b><font style="text-decoration: underline;"><?php echo $request_data['designation']['designations_name'];?></font></b> in our organization.</p>
    </div>



    <div class="footer_details" style="background: #F77F38; color: #fff;">
        <div style="margin-left: 10px;padding: 30px 3px;font-size: 16px;height: 39px;">
            Thanks & Regards,<br>
            <?php echo $settings->hr_name;?><br>
            HR @ eSparkBiz Technologies Pvt. Ltd<br>
            <?php echo $settings->hr_contact;?> | <a href="mailTo:<?php echo $settings->hr_email;?>" style="color: #fff;"><?php echo$settings->hr_email;?></a> | <a href="<?php echo $settings->company_site;?>" target="_blank" style="color: #fff;"><?php echo $settings->company_site;?></a><br>
        </div>
    </div>

</div>
<div style="height: 30px;"></div>
</body>