<?php

namespace App\Http\Controllers;

use App\Models\IvrSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IvrController extends Controller
{
    function generateSessionId()
    {
        $prefix = 'WA'; // Prefix for the account number
        $suffix = time(); // Suffix for the account number (UNIX timestamp)

        // Generate a random number between 1000 and 9999
        $random = rand(100000000000, 999999999999);

        // Combine the prefix, random number, and suffix to form the account number
        $payment_reference_number = $prefix . $random;

        return $payment_reference_number;
    }

    public function ivr(Request $request)
    {
        $phone_number_caller=$request->number;
        $digit=$request->digit;
        Log::info('This is from FreePBX', ['request' => json_encode($request)]);
        Log::info('Caller', ['request' => json_encode($phone_number_caller)]);
        Log::info('Digit', ['request' => json_encode($digit)]);
        $question_id = $request->question_id;

        $language = 1;





        $case_no = 1;
        $step_no = 0;
        $message_string = "";
        $user_message = $request->answer;
        $phone_number =  $request->number;
        $session_id = $this->generateSessionId();

        //getting last session info
        $getLastSessionInfor = IvrSession::where('phone_number', $phone_number)->where('status', 0)->first();

        //checking if there is an active session or not
        if (!empty($getLastSessionInfor)) {
            $case_no = $getLastSessionInfor->case_no;
            $step_no = $getLastSessionInfor->step_no;
            $session_id = $getLastSessionInfor->session_id;
            $language = $getLastSessionInfor->language_id;

            if ($case_no == 1 && $step_no == 1 && !empty($user_message)) {
                $language = $user_message;
                //update the session details
                $update_session = IvrSession::where('session_id', $session_id)->update([
                    "language_id" => $user_message
                ]);

            }

        } else {
            //save new session record
            $new_session = IvrSession::create([
                "phone_number" => $phone_number,
                "case_no" => 1,
                "step_no" => 0,
                "session_id" => $session_id,
                "language_id" => $language
            ]);
            $new_session->save();
        }

        switch ($case_no) {
            case '1':
                if ($case_no == 1 && $step_no == 0) {

                    $update_session = IvrSession::where('session_id', $session_id)->update([
                        "case_no" => 1,
                        "step_no" => 1
                    ]);

                    $custom_response = [
                        "next_question" => "Second_IVR_2_1_Choose_Province_(English)"
                    ];

                    return response()->json(['RESULT' => 'SUCCESS']);
                }elseif ($case_no == 1 && $step_no == 1 && !empty($user_message)) {

                        if ($language == 1) //english
                        {
                            $update_session = IvrSession::where('session_id', $session_id)->update([
                                "case_no" => 1,
                                "step_no" => 2
                            ]);

                            $custom_response = [
                                "next_question" => "Second_IVR_2_1_Choose_Province_(English)"
                            ];

                            return response()->json(['RESULT' => 'SUCCESS']);

                        } elseif ($language == 2) //nyanja
                        {
                            $update_session = IvrSession::where('session_id', $session_id)->update([
                                "case_no" => 1,
                                "step_no" => 2
                            ]);

                            $custom_response = [
                                "next_question" => "question_3"
                            ];

                            return response()->json(['RESULT' => 'SUCCESS']);
                        } elseif ($language == 3) //bemba
                        {
                            $update_session = IvrSession::where('session_id', $session_id)->update([
                                "case_no" => 1,
                                "step_no" => 2
                            ]);

                            $custom_response = [
                                "next_question" => "question_3"
                            ];

                            return response()->json(['RESULT' => 'SUCCESS']);
                        } elseif ($language == 4) //tonga
                        {
                            $update_session = IvrSession::where('session_id', $session_id)->update([
                                "case_no" => 1,
                                "step_no" => 2
                            ]);

                            $custom_response = [
                                "next_question" => "question_3"
                            ];

                            return response()->json(['RESULT' => 'SUCCESS']);
                        } elseif ($language == 5) //kaonde
                        {
                            $update_session = IvrSession::where('session_id', $session_id)->update([
                                "case_no" => 1,
                                "step_no" => 2
                            ]);

                            $custom_response = [
                                "next_question" => "question_3"
                            ];

                            return response()->json(['RESULT' => 'SUCCESS']);
                        } elseif ($language == 6) //lunda
                        {
                            $update_session = IvrSession::where('session_id', $session_id)->update([
                                "case_no" => 1,
                                "step_no" => 2
                            ]);

                            $custom_response = [
                                "next_question" => "question_3"
                            ];

                            return response()->json(['RESULT' => 'SUCCESS']);
                        } elseif ($language == 7) //luvale
                        {
                            $update_session = IvrSession::where('session_id', $session_id)->update([
                                "case_no" => 1,
                                "step_no" => 2
                            ]);

                            $custom_response = [
                                "next_question" => "question_3"
                            ];

                            return response()->json(['RESULT' => 'SUCCESS']);
                        }
                    }
                break;
        }
    }
}
