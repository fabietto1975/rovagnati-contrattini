@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../lisachenko/go-aop-php/bin/warmup
php "%BIN_TARGET%" %*
