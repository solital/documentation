from setuptools import setup, find_packages

VERSION = '4.0'

setup(
    name="solital_docs_theme",
    version=VERSION,
    url='https://github.com/mkdocs/mkdocs-basic-theme',
    license='BSD',
    description='Minimal theme for Solital Framework',
    author='Brenno Duarte',
    packages=find_packages(),
    include_package_data=True,
    entry_points={
        'mkdocs.themes': [
            'basictheme = solital_docs_theme',
        ]
    },
    zip_safe=False
)
