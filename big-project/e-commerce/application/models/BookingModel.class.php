<?php
// insertion d'une demande de RDv

class BookingModel
{
    public  function create($customer_Id,$bookingDate,$bookingTime,$numberOfSeats)
    {
        $database = new Database();
        $sql= ("INSERT INTO Booking
                    (
                        Customer_Id,
                        BookingDate,
                        BookingTime,
                        NumberOfSeats,
                        CreationTimestamp
                    )
                    VALUES
                    (?,?,?,?,NOW())");

        $database->executeSql($sql,[ $customer_Id,$bookingDate,$bookingTime,$numberOfSeats]);

        // Ajout d'un message de notification.
        $flashBag = new FlashBag();
        $flashBag->add('Votre réservation est bien enregistrée, nous vous en remercions.');
    }

}