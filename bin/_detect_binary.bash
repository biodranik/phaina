#!/bin/bash
#
# Automatically detects if binary with the same name is installed in the system
# or can be found in the same directory.
#
# by Alexander Zolotarev <me@alex.bio> from Minsk, Belarus.
#
# Useful debug options:
# -e aborts if any command has failed.
# -u aborts on using unset variable.
# -x prints all executed commands.
# -o pipefail aborts if on any failed pipe operation.
set -euo pipefail

ME=`basename "$0"`
SCRIPT_DIR=`dirname $BASH_SOURCE`

# First parameter is a binary name (or prefix).
FindBinary() {
  # Set default os type to Windows.
  local OS="windows"
  if [[ "$OSTYPE" == "darwin"* ]]; then
    OS=darwin
  elif [[ "$OSTYPE" == *"linux"* ]]; then
    OS=linux
  fi
  # Arch setup.
  local ARCH="386"
  if [[ `uname -m` == "x86_64" ]]; then
    ARCH=amd64
  fi
  # Try to match with local binary.
  for f in $SCRIPT_DIR/$1*$OS*$ARCH*; do
    [ -e "$f" ] && { echo "$f"; } || return 1  # return non-zero error code
    break
  done
}

# Check if binary exists in the PATH and try to replace it by a local file.
BINARY="$ME"
RET=0
type -P "$ME" >/dev/null 2>&1 || { BINARY=`FindBinary "$ME"`; RET=$?; }
if [[ $RET -ne 0 ]]; then
  echo "Error: $ME is not installed.";
  if [[ "$OSTYPE" == "darwin"* ]]; then
    echo "You can use Homebrew to install it: \`brew install $ME\`";
  fi
  exit 1;
fi

# Launch found binary.
"$BINARY" $@
