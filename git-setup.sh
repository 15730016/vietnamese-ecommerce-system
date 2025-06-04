#!/bin/bash

# 1. Initialize git repository if not already initialized
if [ ! -d ".git" ]; then
  git init
  echo "Git repository initialized."
else
  echo "Git repository already initialized."
fi

# 2. Add only vietnamese-ecommerce-system directory and commit with message "Initial commit"
git add vietnamese-ecommerce-system
git commit -m "Initial commit"

# 3. Add remote origin if not exists
REMOTE_URL="https://github.com/15730016/vietnamese-ecommerce-system.git"
if git remote | grep origin; then
  echo "Remote origin already exists."
else
  git remote add origin $REMOTE_URL
  echo "Remote origin added."
fi

# 4. Push to main or master branch
if git show-ref --verify --quiet refs/heads/main; then
  BRANCH="main"
elif git show-ref --verify --quiet refs/heads/master; then
  BRANCH="master"
else
  BRANCH="main"
  git branch -M main
fi

git push -u origin $BRANCH

echo "Push to remote $BRANCH branch done."

# 5. Instructions for updating code if remote exists
echo ""
echo "To update code after initial setup:"
echo "1. git add vietnamese-ecommerce-system"
echo "2. git commit -m \"Your commit message\""
echo "3. git push origin $BRANCH"
