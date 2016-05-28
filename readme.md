# 直播平台

## nginx + rtmp + hls + ffmpeg + PHP

- laravel, 使用前`composer install`


```ini
# Example
# rtmp串流, rtmp播放(延迟低, 2~3s)
rtmp {
        server {
            listen 1935;
            chunk_size 4096;
            application live {
                live on;
                on_publish http://127.0.0.1/publish; #开始串流回调事件(可密钥验证, 代码返回http状态为2xx为成功)
                on_publish_done http://127.0.0.1/publishdone; #串流停止回调事件
                notify_method get; #上面的回调链接通知方式为GET
                exec /opt/ffmpeg/bin/ffmpeg -y -i rtmp://localhost/live/$name -threads 1 -f image2 -an -vf fps=fps=1/20 -updatefirst 1 /var/www/public/images/live_room/$name.jpg; # 每20s对直播进行截图
            }

        }
}

# rmtp串流, 并支持rtmp播放同时支持hls播放切片配置(18s+延迟)
rtmp {
        server {
            listen 1935;
            chunk_size 4096;
            application live {
                live on;
                hls on;
                hls_path /tmp/live;
                hls_fragment 3s; #切片参数
                hls_playlist_length 9s;
                hls_sync 100ms;
                on_publish http://127.0.0.1/publish;
                on_publish_done http://127.0.0.1/publishdone;
                notify_method get;
                exec /opt/ffmpeg/bin/ffmpeg -y -i rtmp://localhost/live/$name -threads 1 -f image2 -an -vf fps=fps=1/20 -updatefirst 1 /var/www/public/images/live_room/$name.jpg;
            }

        }
}


http{
        location /live {
                        types {
                            application/vnd.apple.mpegurl m3u8;
                            video/mp2t ts;
                        }
                        root /tmp;
                        add_header Cache-Control no-cache;
                        add_header Access-Control-Allow-Origin *;
        }
}

```

