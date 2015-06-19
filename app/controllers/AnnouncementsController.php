<?php

class AnnouncementsController extends \BaseController {

    public function getIndexView()
    {
        return View::make('announcements.index');
    }

    public function getListView()
    {
        return View::make('announcements.list');
    }

    public function getDataView()
    {
        $notificationsOfUser = Announcement::all();

        $returnData = [];
        $img_extensions = ['gif', 'jpg', 'png'];
        foreach ($notificationsOfUser as $key => $notification) {

            $returnData[$key]['id'] = $notification->notification_tos_id;
            $returnData[$key]['subject'] = $notification->subject;
            $returnData[$key]['from'] = $notification->from;
            $returnData[$key]['avatar'] = User::find($notification->from)->profile_image;
            $returnData[$key]['to'] = '';
            $returnData[$key]['content'] = $notification->content;
            $returnData[$key]['attach'] = json_decode($notification->attach, true);
            $returnData[$key]['date'] = date('H:i m/d/Y', strtotime($notification->created_at));
            $returnData[$key]['label'] = $notification->label;

            if (count($returnData[$key]['attach']) > 0) {
                foreach ($returnData[$key]['attach'] as $k => $attach) {
                    $extension = File::extension($attach['url']);
                    if (!in_array($extension, $img_extensions)) {
                        $attach['image_url'] = 'img/images.png';
                    }else{

                        $attach['image_url'] = $attach['url'];

                    }
                    $returnData[$key]['attach'][$k] = $attach;
                }
            }
        }

        return ['mails' => $returnData];
    }

    public function getDetailView()
    {
        return View::make('announcements.detail');
    }

    public function getCreateAdd()
    {
        return View::make('announcements.create');
    }

    public function postUsersAdd()
    {
        $data = User::select('user_id','first_name')->get();
        return Response::json($data);

    }

    public function postStoreAdd()
    {
        $announcements = new Announcement();
        $announcements->to = json_encode(Input::get('to'));
        $announcements->subject = Input::get('subject');
        $announcements->content = Input::get('content');
        $announcements->label = Input::get('label');
        $announcements->from = Auth::user()->user_id;
        $save = $announcements->save();

        $notification = new Notification();
        $notification->subject = Input::get('subject');
        $notification->content = Input::get('content');
        $notification->label = Input::get('label');
        $notification->from = Auth::user()->user_id;
        $notification->save();
        $to = (Input::get('to'));

        foreach($to as $key => $user)
        {

            $notification_tos = new NotificationTo();
            $notification_tos->notifications_id = $notification->notifications_id;
            $notification_tos->users_id = $user;
            $notification_tos->save();
        }

        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.store_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }

    public function postStoreResumeAdd()
    {
        $announcements = new Announcement();
        $announcements->to = json_encode(Input::get('to'));
        $announcements->subject = Input::get('subject');
        $announcements->content = Input::get('content');
        $announcements->label = Input::get('label');
        $announcements->from = Auth::user()->user_id;
        if (Input::hasFile('attach')) {
            $file = Input::file('attach');

            $destinationPath = public_path() . '/uploads/announcements_attachments/';

//            $filename = 'profile_image.' . $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
        } else {
            $uploadSuccess = "";
        }

        if ($uploadSuccess) {
            $announcements->attach = "/uploads/announcements_attachments/". $filename;
        }
        $save = $announcements->save();

        $attach=['name'=>$filename,'url'=>$announcements->attach];
        $notification = new Notification();
        $notification->subject = Input::get('subject');
        $notification->content = Input::get('content');
        $notification->label = Input::get('label');
        $notification->from = Auth::user()->user_id;
        $notification->attach = '['.json_encode($attach).']';
        $notification->save();
        $to = json_decode(Input::get('to'));

        foreach($to as $key => $user)
        {

            $notification_tos = new NotificationTo();
            $notification_tos->notifications_id = $notification->notifications_id;
            $notification_tos->users_id = $user;
            $notification_tos->save();
        }
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.store_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }
}
