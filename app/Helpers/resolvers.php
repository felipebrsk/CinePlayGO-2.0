<?php

use App\Services\{
    S3Service,
};

if (!function_exists('s3Service')) {
    /**
     * Resolve the s3 service.
     *
     * @return \App\Services\S3Service
     */
    function s3Service(): S3Service
    {
        return resolve(S3Service::class);
    }
}
