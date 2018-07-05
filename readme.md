# Carnegie Coding Check - Multi-Get

## Specification

An application that downloads parts of a file from a web server.

1. Download complete file.
1. Download part of a file using the 'Range' header.
1. Only download the first 4MiB in 1MiB chunks.
1. Write to disk.

### Requirements

1. Source specified by cli option.
1. File is downloaded in 4 parts (4 requests to server).
1. Only the first 4MiB of the file should be downloaded.
1. Output file may be specified with a cli option.
1. Output file may have default.
1. No corruption.
1. File retrieved using GET requests.

## Optional

1. Parallel download
1. **Support files smaller than 4MiB**
1. **Configurable number of chunks, chunk size, and total download size.**

## Out of Scope

1. HTTPS
1. Range header unsupported/fallback
1. Other HTTP methods
1. Re-use existing connections with keep-alive

## Application Requirements

1. PHP 7.1

## Setup

```bash
php composer.phar install
```

## CLI Commands

There is only one command supported.

### Download

```bash
bin/download
    --url=URL STRING
    [--output=FILE PATH]
    [--parts=NUMBER|4]
    [--part-size=NUMBER|1MiB]
    [--download-size=NUMBER|4MiB]
```

* `--url` (STRING) **required**

    Address to download file.
* `--output` (STRING) *optional*

    Path to file on file system. Will overwrite file. 
    
        Defaults to ./ccc.file.
* `--parts` (NUMBER) *optional*
    
    Number of requests in order to chunk the file downloaded.
    
        Defaults to 4.
* `--part-size` (NUMBER) *optional*

    Number of bytes for each chunk.
    
        Defaults to 1MiB.
* `--download-size` (NUMBER) *optional*
    
    Number of bytes to download in total.
    
        Defaults to 4MiB.