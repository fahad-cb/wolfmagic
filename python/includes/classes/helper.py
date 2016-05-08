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

	def is_video(self, path, msg = False):
		formats = ['mp4','MP4', 'wmv', 'webm', 'ogv', 'mov', '3gp','flv', 'MPEG', 'mpeg', 'mpeg4']	
		ext = self.getExtension(path)
		for vtype in formats:
			if (ext == "."+vtype):
				if (msg):
					print ext + " is valid video "
				return ext
		if (msg):
			print ext + " is invalid video file"
		return False

	def is_audio(self, path, msg = False):
		formats = ['mp3', 'wav', 'aac', 'ogg', 'oga', 'wav', 'wma', 'webm']	
		ext = self.getExtension(path)
		for vtype in formats:
			if (ext == "."+vtype):
				if (msg):
					print ext + " is valid audio "
				return ext
		if (msg):
			print ext + " is invalid audio file"
		return False

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