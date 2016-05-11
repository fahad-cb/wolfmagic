class HuntHelp(object):
	global ffmpeg
	ffmpeg = 'C:/xamppPHP7/htdocs/wolfmagic.git/trunk/libs/ffmpeg.exe'
	"""docstring for WolfMagic"""
	def getExtension(self, file):
		extension = os.path.splitext(file)[1]
		return extension

	def isFile(self, fname):
		import os
		if (os.path.isfile(fname)):
			return fname
		else:
			return False

	def isWindows(self):
		import os
		if (os.name == 'nt'):
			return True
		else:
			return False

	def cmd(self, cmd, out = True):
		import os
		data = os.system(cmd)
		return data

	def isMedia(self, path, mtype, msg = False):
		if (mtype == 'v'):
			theVtype = 'video'
			formats = ['mp4','MP4', 'wmv', 'webm', 'ogv', 'mov', '3gp','flv', 'MPEG', 'mpeg', 'mpeg4']
		else if (mtype == 'a'):
			theVtype = 'audio'
			formats = ['mp3', 'wav', 'aac', 'ogg', 'oga', 'wav', 'wma', 'webm']
		else:
			theVtype = 'photo'
			formats = ['jpg', 'JPG', 'JPEG', 'png', 'PNG', 'bmp', 'BMP', 'ICO']
		ext = self.getExtension(path)
		for vtype in formats:
			if (ext == "."+vtype):
				if (msg):
					print ext + " is valid " + theVtype + " file "
				return ext
		if (msg):
			print ext + " is invalid " + theVtype + " file"
		return False


	def is_video(self, path, msg = False):
		return self.isMedia(path, 'v', msg)

	def is_audio(self, path, msg = False):
		return self.isMedia(path, 'a', msg)

	def is_photo(self, path, msg = False):
		return self.isMedia(path, 'p', msg)

	def got_ffmpeg(self, path = False, msg = False):
		if (self.isWindows()):
			global ffmpeg
			path = ffmpeg
		
		if (not path):
			ffmpeg = self.cmd('which ffmpeg')
		else:
			ffmpeg = self.isFile(path)

		if (ffmpeg):
			if (msg):
				print 'FFMPEG is installed at ' + ffmpeg
			return ffmpeg
		else:
			if (msg):
				print 'FFMPEG installation not found'
			return False

	def is_type(self, filepath, ext):
		if (self.isFile(filepath)):
			fext = self.getExtension(filepath)
			if (fext == "."+ext):
				return ext
			else return False
		else:
			return False