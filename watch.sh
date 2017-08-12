#!/bin/bash
#
# Watches for scss files changes and automatically recompiles them.
#
# by Alexander Borsuk <me@alex.bio> from Minsk, Belarus.
#
# Useful debug options:
# -e aborts if any command has failed.
# -u aborts on using unset variable.
# -x prints all executed commands.
# -o pipefail aborts if on any failed pipe operation.
set -euo pipefail

# Path to the directory which is monitored for changes by fswatch.
SCSS_DIR="scss"
# File which is rebuilt by sassc on any change in the directory above.
SASSC_INPUT_SCSS="$SCSS_DIR/style.scss"
# Automatically generated css file.
SASSC_OUTPUT_CSS="www/css/style.css"
# One of: nested, expanded, compact, compressed.
OUTPUT_CSS_FORMAT="nested"

# Binaries in bin directory are wrappers which finds correct ones in the system
# or take version from the bin directory itself.
SASSC_BINARY="bin/sassc"
FSWATCH_BINARY="bin/fswatch"
# Use PHP from the PATH.
PHP_BINARY="php"

# Simple sound in case of error.
if [[ "$OSTYPE" == "darwin"* ]]; then
  SASSC_FAILED_COMMAND="say CSS compilation error"
else
  SASSC_FAILED_COMMAND="echo -ne \a\a"  # 2 beeps/bells in case of error.
fi

# Kill all background processes in the current process group on exit (ctrl+C).
trap 'kill 0' EXIT

"$PHP_BINARY" -S localhost:8888 -t www &

# Small helper.
rebuildCSS() {
  # Do not stop after sassc returned error, because it can be caused by invalid scss syntax.
  "$SASSC_BINARY" --style "$OUTPUT_CSS_FORMAT" "$SASSC_INPUT_SCSS" "$SASSC_OUTPUT_CSS" || $SASSC_FAILED_COMMAND
}

echo "Rebuilding $SASSC_OUTPUT_CSS"
rebuildCSS

"$FSWATCH_BINARY" -0 -r -l 0.1 --event=Renamed --event=Removed --event=Updated --event=Created "$SCSS_DIR" | while IFS= read -r -d '' CHANGED_FILE
do
  # Display relative path instead of absolute one.
  CHANGED_FILE=${CHANGED_FILE#$PWD/}
  echo "Rebuilding $SASSC_OUTPUT_CSS due to changed file: $CHANGED_FILE"
  rebuildCSS
done

# Wait for all background processes to complete.
wait
