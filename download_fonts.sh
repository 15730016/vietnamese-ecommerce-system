#!/bin/bash

# Create fonts directory
mkdir -p public/shared/fonts

# Download Be Vietnam Pro font files from Google Fonts
wget -O public/shared/fonts/BeVietnamPro-Regular.woff2 "https://fonts.gstatic.com/s/bevietnampro/v11/QdVPSTAyLFyeg_IDWvOJmVES_HRUBX8.woff2"
wget -O public/shared/fonts/BeVietnamPro-Medium.woff2 "https://fonts.gstatic.com/s/bevietnampro/v11/QdVMSTAyLFyeg_IDWvOJmVES_HCKhgr_.woff2"
wget -O public/shared/fonts/BeVietnamPro-SemiBold.woff2 "https://fonts.gstatic.com/s/bevietnampro/v11/QdVMSTAyLFyeg_IDWvOJmVES_HCYhQr_.woff2"

# Make script executable
chmod +x download_fonts.sh
