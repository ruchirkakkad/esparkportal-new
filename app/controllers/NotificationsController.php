<?php

class NotificationsController extends \BaseController
{

    public function getIndex()
    {
        return View::make('notifications.index');
    }

    public function getList()
    {
        return View::make('notifications.list');
    }

    public function getData()
    {
        $notificationsOfUser = NotificationTo::where('users_id', '=', Auth::user()->user_id)
            ->join('notifications', 'notifications.notifications_id', '=', 'notification_tos.notifications_id')
            ->orderBy('notifications.created_at','desc')->get();

        $returnData = [];
        $img_extensions = ['gif', 'jpg', 'png'];
        foreach ($notificationsOfUser as $key => $notification) {
//            var_dump($notification->attach);
//            var_dump(json_decode('[{"name":"languages.csv","url":"uploads/admin@admin.com/attachments/languages.csv"}]',true));
//            var_dump(json_decode($notification->attach,true));
            $returnData[$key]['id'] = $notification->notification_tos_id;
            $returnData[$key]['subject'] = $notification->subject;
            $returnData[$key]['from'] = $notification->from;
            $returnData[$key]['avatar'] = User::find($notification->from)->profile_image;
            $returnData[$key]['to'] = '';
            $returnData[$key]['content'] = $notification->content;
            $returnData[$key]['attach'] = json_decode($notification->attach, true);
            $returnData[$key]['date'] = date('H:i m/d/Y', strtotime($notification->created_at));
            $returnData[$key]['label'] = $notification->label;
            $returnData[$key]['fold'] = $notification->status;

            if (count($returnData[$key]['attach']) > 0) {
                foreach ($returnData[$key]['attach'] as $k => $attach) {
                    $attach['url'] = json_decode($attach['url'],true);
//                    dd($attach['url'][0]['url']);
                    $extension = File::extension($attach['url'][0]['url']);
                    if (!in_array($extension, $img_extensions)) {
                        $attach['image_url'] = 'img/images.png';
                    }else{

                        $attach['image_url'] = $attach['url'][0]['url'];

                    }
                    $returnData[$key]['attach'][$k] = $attach;
                }
            }
        }

        return ['mails' => $returnData];
    }

    public function getDetail()
    {
        return View::make('notifications.detail');
    }
    public function getDetailStatusChange($id)
    {
        $noti = NotificationTo::find($id);
        $noti->status = 'read';
        echo $noti->save();
    }
} 