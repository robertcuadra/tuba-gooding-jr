using terms from application "iChat"
	on message received theMessage from theBuddy for theChat
		set buddyHandle to handle of theBuddy
		set x to do shell script "/usr/bin/env php /projects/prgmtk/tuba-gooding-jr/tuba-gooding-jr.php \"" & buddyHandle & "\" \"" & theMessage & "\""
		if x is not equal to "no" then
			tell application "iChat"
				send x to theBuddy
			end tell
		end if
	end message received

	on received text invitation theMessage from theBuddy for theChat
		set buddyHandle to handle of theBuddy
		set x to do shell script "/usr/bin/env php  /projects/prgmtk/tuba-gooding-jr/tuba-gooding-jr.php \"" & buddyHandle & "\" \"" & theMessage & "\""
		if x is not equal to "no" then
			tell application "iChat"
				send x to theBuddy
			end tell
		end if
	end received text invitation
end using terms from