<?php
// Enregistrement de la reservation

class BookingController{

    public function httpGetMethod(Http $http)
    {
        $userSession = new UserSession;

        if($userSession->isAuthenticated()==false)
        {
            $http->redirectTo('/user/login');
        }
    }

    public function httpPostMethod(Http $http,array $formFields)
    {
        $userSession = new UserSession;

        if($userSession->isAuthenticated()==false)
        {
            $http->redirectTo('/user/login');
        }


            $bookingDate = $formFields['bookingYear'] . '-' . $formFields['bookingMonth'] . '-' . $formFields['bookingDay'];
            $bookingTime = $formFields['bookingHour'] . ':' . $formFields['bookingMinutes'];

            $bookingModel = new BookingModel();
            $bookingModel->create(
                $userSession->getCustomer_Id(),
                $bookingDate,
                $bookingTime,
                $formFields['bookingSeat']

            );

        $http->redirectTo('/');




    }
}