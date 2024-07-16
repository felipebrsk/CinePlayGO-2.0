<?php

use App\Services\{
    S3Service,
    CartService,
    CouponService,
    TitleService,
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

if (!function_exists('titleService')) {
    /**
     * Resolve the title service.
     *
     * @return \App\Services\TitleService
     */
    function titleService(): TitleService
    {
        return resolve(TitleService::class);
    }
}

if (!function_exists('cartService')) {
    /**
     * Resolve the cart service.
     *
     * @return \App\Services\CartService
     */
    function cartService(): CartService
    {
        return resolve(CartService::class);
    }
}

if (!function_exists('couponService')) {
    /**
     * Resolve the cart service.
     *
     * @return \App\Services\CouponService
     */
    function couponService(): CouponService
    {
        return resolve(CouponService::class);
    }
}
