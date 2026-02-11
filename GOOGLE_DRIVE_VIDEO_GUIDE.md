# How to Embed Google Drive Videos

## Steps to Get an Embed URL from Google Drive:

1. **Upload your video** to Google Drive
2. **Right-click** on the video file and select **"Open with"** > **"Google Drive"**
3. **Click the share button** (top right) and set visibility to **"Anyone with the link"** or **"Public"**
4. **Look at the URL bar** - it should be something like:
   ```
   https://drive.google.com/file/d/FILE_ID_HERE/view
   ```
5. **Change `/view` to `/preview`** to get the embed URL:
   ```
   https://drive.google.com/file/d/FILE_ID_HERE/preview
   ```

## In Admin Dashboard:

1. Go to **Admin** > **Videos**
2. Click **"Add Video"**
3. Fill in:
   - **Title**: Name of the video
   - **Description**: Brief description
   - **Google Drive Embed URL**: The preview URL from step 5 above
   - **Display Order**: 0 for first, 1 for second (only 2 videos show on homepage)
   - **Active**: Check this to show on homepage

4. Click **"Create Video"**

## Tips:

- Only the first 2 active videos (ordered by display_order) will show on the homepage
- Make sure your Google Drive video is publicly accessible
- Use descriptive titles and descriptions

That's it! The videos will appear on your homepage immediately.
