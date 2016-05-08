class HuntHelp(object):
	"""docstring for WolfMagic"""
	def getExtension(self, file):
		import os.path
		extension = os.path.splitext(file)[1]
		return extension

	def is_video(self, path, msg = False):
		formats = ['mp4','MP4', 'wmv', 'webm', 'ogv', 'mov', '3gp','flv', 'MPEG', 'mpeg', 'mpeg4']	
		ext = self.getExtension(path)
		for vtype in formats:
			if (ext == "."+vtype):
				return ext
		return False