#!/usr/bin/env sh

realpath() {
    [[ $1 = /* ]] && echo "$1" || echo "${PWD}/${1#./}"
}

script_dir=`realpath "$0"`
bin_dir=`dirname "${script_dir}"`
root_dir=`dirname "${bin_dir}"`

docker run -t --rm \
    --mount type=bind,source="${root_dir}",target=//opt/project \
    --user=$(id -u):$(id -g) \
    --entrypoint=fixuid \
    $(docker build -f "${root_dir}/Dockerfile" "${root_dir}" -q) -q php "$@"
