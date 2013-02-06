---
layout: post
title: Steam Tools
categories: [other]
---

Tools confirmed to be working
-----------------------------


Tools with Missing Executable
-----------------------------
- [Counter-Strike Global Offensive - Dedicated Server]() [steam://install/740/](steam://install/)
> This server is not listed under Tools  
- [Half-Life Dedicated Server]() [steam://install/90](steam://install/90)
- [Red Orchestra Linux Dedicated Server]() [steam://install/223250](steam://install/223250)

Tools that fails to launch
--------------------------
- [Serious Sam 3 Dedicated Server]() [steam://install/41080](steam://install/41080)
> The script fails to escape spaces from within Steam, it can be launched with:  
> cd ~/.Steam/SteamApps/common/Serious\ Sam\ 3; ./runSam3_DedicatedServer.sh  
- [Nuclear Dawn - Dedicated Server]() [steam://install/111710](steam://install/111710)
> Tries to launch the dedicated server for windows, this can be circumvented with:  
> cd ~/.Steam/SteamApps/common/Nuclear\ Dawn; LD_LIBRARY_PATH=$LD_LIBRARY_PATH:bin:. ./srcds_linux  -steam -game nucleardawn

Tools listed as games
---------------------
- [Killing Floor Dedicated Server - Linux]() [steam://install/215360](steam://install/215360)

Tools with Linux information that does not install
--------------------------------------------------
- [Counter-Strike Global Offensive - Valve Dedicated Server]()
> If run through [steam://install/741](steam://install/741), the client will be redirected to the store
