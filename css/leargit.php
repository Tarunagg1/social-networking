<!-- setup -->
git config --globle user.name your name
git config --globle user.email your email

git config --globle user.name

<!-- .start here -->
git init
ls -lart
git status  //to know the status of file tracked or untrackrd
git status -s // to show more info 
git add     //use to add a single file in track mode
git add -A     //use to add a all file in track mode
git commit  //for final commit open vim to enter a msgfmt_format_message
git commit -m "Your message"  //for final commit but not open vim editor
git commit -a -m "enter message" /// it is use to add file in track area and commit

<!-- Operational in git -->
git checkout filename    ////for recover one file in commit
git checkout -f      ////for recover all file in commit
git log    //// to show all commit and time
git log -p -no of commit  //// to show filter commit log
git diff  // it compare working dir with stage area
git diff --staged // it compare working dir with last commit
git rm  // it is user to remove form working dir or stage area
git em --cached filename //it is use to remove form stage area
touch filename.extension  // it is use to create file
touch .gitignore //take a file name and ignore these file


<!-- branch -->
git branch feature  // to create new branch
git branch ///to show all branches
git checkout master // to move one branch to another
git marge fileename to master //to mearge 2 branch


<!-- to deploye to github web -->
git remote add origin-name link   ///to add remote directory
git remote // to see all remote
git remote -v  ////to see all remote with urldecode
git push -u origin-name master // to push to all file on github
git remote st-url remote-name url   // it is user to change url 


