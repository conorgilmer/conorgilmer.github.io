title=Moblie development with Corona SDK/Lua
date=2013-9-6
type=post
tags=blog
status=published
~~~~~~

Well I have been doing a small project to develop on Corona SDK with Lua. The resources online are excellent, and youtube videos seem to get you up and running very quickly. I like the fact you can develop both for Android and iOS with the same code base.

Lua (<http://www.lua.org>) is a nice language and with you can pick it up fairy quickly. I did feel like i was touching base with my educational qualifications, when using the physics library for bouncing etc.

Some tools i found useful were the Sublime Text editor initially, i did try eclipse some swings to get debugging to work, however i settled on using LuaGlider which i found handy and code completion is excellent.

The issues I had(have) was actually deploying on my phone, initially there was an issue in that to compile i had to down grade from Java 1.7 to 1.6, and also use the 32 version not 64. While it didn’t deploy to my phone it did install on others. As i searched i found it was to do with my phones processor the ARMv6 is no longer supported …dooh..

I did use an earlier Corona SDK version from 2011 which did deploy on my phone however it uses legacy libraries and not common modern ones especially such fundamental ones as widget.

I shall plow on…
