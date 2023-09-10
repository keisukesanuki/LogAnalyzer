# LogAnalyzer

## これは何？

WEB サーバのアクセスログを解析するツールです。  
※ Apache / Nginx に対応  

## Installation

- For Docker
```
git clone https://github.com/snkk1210/LogAnalyzer.git
cd LogAnalyzer
docker-compose up -d
```

- For LAMP server
```
git clone https://github.com/snkk1210/LogAnalyzer.git
chmod 777 LogAnalyzer/upload
```

## Usage
一番左の input フォーム(灰色)は、ログフォーマットのリクエスト時刻を変更しているログに対しての調整用途にご利用ください。   

![LogAnalyzer_usage01](https://user-images.githubusercontent.com/46625712/185736408-184ecba5-0f97-4d89-95e4-b0e2da50dbff.gif)