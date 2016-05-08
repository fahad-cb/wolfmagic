class HuntHelp(object):
	"""docstring for WolfMagic"""
	def getExtension(self, file):
		import os.path
		extension = os.path.splitext(file)[1]
		return extension

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