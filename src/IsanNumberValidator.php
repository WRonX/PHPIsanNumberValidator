<?php
/**
 * ISAN Number Validator
 *
 * Copyright © 2016 WRonX <wronx[at]wronx.net>
 * This work is free. You can redistribute it and/or modify it under the
 * terms of the Do What The Fuck You Want To Public License, Version 2,
 * as published by Sam Hocevar. See http://www.wtfpl.net/ for more details.
 */

namespace WRonX\Utils;

class IsanNumberValidator
{
    public static function format($value)
    {
        if(!self::validate($value))
            throw new \InvalidArgumentException("Invalid ISAN number");

        $value = self::normalize($value);
        
        return sprintf("%s-%s-%s-%s",
                       join('-', str_split(substr($value, 0, 16), 4)),
                       $value[16],
                       join('-', str_split(substr($value, 17, 8), 4)),
                       $value[25]
        );
    }
    
    public static function validate($value)
    {
        $value = self::normalize($value);
        
        if(!ctype_alnum($value))
            return false;
        
        if(strlen($value) != 26)
            return false;
        
        if(base_convert($value[16], 36, 10) != self::getControlNumber(substr($value, 0, 16))) // first control char
            return false;
        
        if(base_convert($value[25], 36, 10) != self::getControlNumber(substr($value, 0, 16) . substr($value, 17, 8))) // second control char
            return false;
        
        return true;
    }
    
    private static function normalize($value)
    {
        return mb_strtoupper(str_replace('-', '', trim($value)));
    }
    
    private static function getControlNumber($value)
    {
        if(!ctype_alnum($value))
            throw new \InvalidArgumentException("Invalid string for validation");

        $adjustedProduct = 36;
        
        for($i = 0; $i < strlen($value); $i++)
        {
            $char = $value[$i];
            $charValue = base_convert($char, 16, 10);
            $intermediateSum = $charValue + $adjustedProduct;
            $adjustedIntermediateSum = self::getAdjustedIntermediateSum($intermediateSum);
            $product = $adjustedIntermediateSum * 2;
            $adjustedProduct = self::getAdjustedProduct($product);
        }
        if($adjustedProduct == 1)
            return 0;
        else
            return 37 - $adjustedProduct;
    }
    
    private static function getAdjustedIntermediateSum($intermediateSum)
    {
        if(!is_numeric($intermediateSum) || $intermediateSum < 0)
            throw new \InvalidArgumentException("Invalid Intermediate Sum");
        
        if($intermediateSum >= 36)
            $intermediateSum -= 36;
        
        return $intermediateSum == 0 ? 36 : $intermediateSum;
    }
    
    private static function getAdjustedProduct($product)
    {
        if(!is_numeric($product) || $product < 0)
            throw new \InvalidArgumentException("Invalid Product");
        
        if($product >= 37)
            return $product - 37;
        
        return $product;
    }
}

