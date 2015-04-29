Games, on Steam for Linux [![Build Status](https://travis-ci.org/SteamDatabase/SteamLinux.png?branch=gh-pages)](https://travis-ci.org/SteamDatabase/SteamLinux)
=========================
This is the source code for *Games, on Steam for Linux*

License
-------
The contents are under the public domain.

Contribution
------------
If you want to edit the list, make a fork on GitHub, make your changes and then
make a pull request through GitHub. Describe your changes and be thorough!
Follow the format below, cite sources, etc.

When editing the `GAMES.json` file, remember to follow the format with **tabs
as indentation**, not spaces.  Keep in mind that the list must be sorted
numerically.

To set a game as working, you need to add the app number in quotes, and set it
to true. This is the number you’ll see in URLs when browsing the Steam Store.
http://store.steampowered.com/app/40/ would be app 40. You would add **"40":
true,** on a new line.

**Example**

```json
{
	"20": true,
	"30": true,
	"400": true,
	"420": true
}
```

You can add extra information to a game entry with the tags below:
* `"Hidden": true` for betas and game servers that clutter up the list to hide them.
* `"Beta": true` for games that have open beta that can be opted‐in via beta
  branch in game properties. If the beta password is public, you may add that
in a Comment.

If you want to add a comment about additional issues (these should be limited
to Steam functionality lacking between the platforms), there are 2 more tags
you can use:
* `"Comment": "Broken overlay"`
* `"CommentURL": "https://google.com/"` - not required if there is no source URL.

**Examples**
```json
	"57640":
	{
		"Comment": "Steamworks features are unavailable."
	},
```

```json
	"15400":
	{
		"Comment": "May require a workaround to launch without getting stuck in a loop.",
		"CommentURL": "https://wiki.archlinux.org/index.php/Steam/Game-specific_troubleshooting#Harvest:_Massive_Encounter"
	},
```
Make sure that your edits validate before submitting your patch with a tool
like [JSONlint.com](http://jsonlint.com/) or you can use the phpunit script
included in the repo which will validate your edit, it can be called via
`phpunit --configuration .phpunit.xml`. If you’re comfortable with cli edits,
you can use this [pre-commit
hook](https://gist.github.com/johndrinkwater/cd96810e3b277b7e2fb1) to prevent
git from committing faulty edits.

Commit titles should include `%game% (%appid%)` along with your preferred
flavour text. If you have multiple games to confirm and it makes the title
unwieldy, consider breaking the commit into many.

Pull Requests should have clean history, no commits to clean previous commits,
no merges that include --no-ff, etc. They may be rejected or rewritten if this
is the case.

Credits
-------
- [flibitijibibo](https://github.com/flibitijibibo) - Creator of The Big List of Steam Games on GNU/Linux.
- [swordfischer](https://github.com/swordfischer) - Re‐made the list from scratch to use markdown and jekyll, then json.
- [xPaw](https://github.com/xPaw) - Improved the new list by making different stylesheet additions, and other minor improvements.
- [weltall](https://github.com/weltall) - Frequent contributor to the list.
- [soeb](https://github.com/soeb) - Frequent contributor to the list.
- [hypercephalickitten](https://github.com/hypercephalickitten) - Frequent contributor to the list.
- [johndrinkwater](https://github.com/johndrinkwater) - Infrequent contributor to the list.
- And a whole lot of very helpful people! Too many to list, truthfully.

Contact
-------
Most of us can be contacted on either #SteamLUG or #SteamDB on [freenode](https://freenode.net/) IRC server.
