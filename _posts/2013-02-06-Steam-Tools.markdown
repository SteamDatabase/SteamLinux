---
layout: post
title: Steam Tools
categories: [other]
---

Tools confirmed to be working
-----------------------------
- [Serious Sam 3 Dedicated Server]()
> The server starts silently in the background; can be run manually by:  
> cd ~/.Steam/SteamApps/common/Serious\ Sam\ 3; ./runSam3_DedicatedServer.sh  
[steam://install/41080](steam://install/41080)

Tools with Missing Executable
-----------------------------
- [Counter-Strike Global Offensive - Dedicated Server]()
> This server is not listed under Tools.  
[steam://install/740/](steam://install/740)

- [Half-Life Dedicated Server]()  
> cd ~/.Steam/SteamApps/common/hlds/  
> LD_LIBRARY_PATH=$LD_LIBRARY_PATH:. ./hlds_linux -game cstrike +map de_aztec  
[steam://install/90](steam://install/90)

- [Red Orchestra Linux Dedicated Server]()  
> cd ~/.Steam/SteamApps/common/Red\ Orchestra\ Linux\ Dedicated Server/System  
> ./ucc-bin server RO-Odessa.rom?game=ROGame.ROTeamGame -nohomedir  
[steam://install/223250](steam://install/223250)

Tools that fails to launch
--------------------------
- [Nuclear Dawn - Dedicated Server]()  
> It will try to launch ndsrv.exe; can be run manually by:  
> cd ~/.Steam/SteamApps/common/Nuclear\ Dawn  
> LD_LIBRARY_PATH=$LD_LIBRARY_PATH:bin:. ./srcds_linux  -steam -game nucleardawn  
[steam://install/111710](steam://install/111710)

Tools listed as games
---------------------
- [Killing Floor Dedicated Server - Linux]()  
> Works from SteamCMD, might segfault with Steam Client
[steam://install/215360](steam://install/215360)

Tools with Linux information that does not install
--------------------------------------------------
- [Counter-Strike Global Offensive - Valve Dedicated Server]()
> If run through [steam://install/741](steam://install/741), the client will be redirected to the store
