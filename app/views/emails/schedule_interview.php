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
        <p style="margin-left: 10px;padding: 3px;font-size: 16px;">Congratulations...<br>As discussed with you<br>You are shortlisted for the post of <b><font style="text-decoration: underline;"><?php echo $request_data['designation']['designations_name'];?></font></b> in our organization.</p>
        <p style="margin-left: 10px;padding: 3px;font-size: 16px;"><b>Interview Date And Time</b>:</p>
        <p style="margin-left: 10px;padding: 3px;font-size: 16px;">
            <b>Date :- </b><?php echo $candidate_action->date;?><br>
            <b>Time :- </b><?php echo $candidate_action->time;?>
        </p>
        <p style="margin-left: 10px;padding: 3px;font-size: 16px;"><b>Venue :- </b><br><?php echo $settings->company_address;?></p>
        <p style="margin-left: 10px;padding: 3px;font-size: 16px;">For map direction, click on this link <a href="http://goo.gl/SRc3xS" target="_blank" style="color:#006198; ">http://goo.gl/SRc3xS</a><br>
            Please keep your updated CV with you.<br>
            Please confirm for the same.</p>
        <p style="margin-left: 10px;padding: 3px;font-size: 16px;"><?php echo $candidate_action->message;?></p>
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