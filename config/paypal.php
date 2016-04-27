<?php

return [
    // set your paypal credential
    'client_id' => 'AZ4FAVPizPaknQtMFZ86bEKkqUDYLjEYUu3MqryleXdzbn716Cqpycrn_WX3kVR7zkJLSoIxXC6d5s5L',
    'secret' => 'EJCVsloFua4pH9stRaB6wFXJFupwIVFzO1ylI4MPzIvbvst4-N2j6eMHGJgTQAmmEd_XSnQ1Qu8oAx32',
    /**
     * SDK configuration
     */
    'settings' => [
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ],
];