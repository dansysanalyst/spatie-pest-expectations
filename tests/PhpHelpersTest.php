<?php

registerSpatiePestHelpers();

test('requiresMinPhpVersion: should run!')
  ->requiresMinPhpVersion('8.1')
  ->expect(true)->ToBeTrue();

test('requiresMinPhpVersion: should be skipped')
  ->requiresMinPhpVersion('25.2')
  ->expect(true)->ToBeTrue();

test('whenPhpVersion: should be skipped')
  ->whenPhpVersion('25.2')
  ->expect(true)->ToBeTrue();

test('skipWhenFileExists: should run!')
  ->skipWhenFileExists(sys_get_temp_dir().DIRECTORY_SEPARATOR.rand())
  ->expect(true)->ToBeTrue();

test('skipWhenFileExists: should be skipped')
  ->skipWhenFileExists(__FILE__)
  ->expect(true)->ToBeTrue();

test('requiresFile: should be skipped')
  ->requiresFile(sys_get_temp_dir().DIRECTORY_SEPARATOR.rand())
  ->expect(true)->ToBeTrue();

test('requiresFile: should run!')
  ->requiresFile(__FILE__)
  ->expect(true)->ToBeTrue();

test('requiresServerToBeAvailable: should be skipped')
  ->requiresServerToBeAvailable('localhost', '65536')
  ->expect(true)->ToBeTrue();

test('requiresServerToBeAvailable: should run!')
  ->requiresServerToBeAvailable('google.com', '80')
  ->expect(true)->ToBeTrue();

test('requiresDependency: should run!')
  ->requiresDependency('spatie/ray')
  ->expect(true)->ToBeTrue();

test('requiresDependency: should be skipped')
  ->requiresDependency('spatie/foobar')
  ->expect(true)->ToBeTrue();

test('skipWhenDependencyExists: should run!')
  ->skipWhenDependencyExists('spatie/foobar')
  ->expect(true)->ToBeTrue();

test('skipWhenDependencyExists: should be skipped')
  ->skipWhenDependencyExists('spatie/ray')
  ->expect(true)->ToBeTrue();

test('requiresPhpExtension: should run!')
  ->requiresPhpExtension('ctype')
  ->expect(true)->ToBeTrue();

test('requiresPhpExtension: should be skipped')
  ->requiresPhpExtension('foobar')
  ->expect(true)->ToBeTrue();

test('skipWhenPhpExtensionExists: should run!')
  ->skipWhenPhpExtensionExists('foobar')
  ->expect(true)->ToBeTrue();

test('skipWhenPhpExtensionExists: should be skipped')
  ->skipWhenPhpExtensionExists('ctype')
  ->expect(true)->ToBeTrue();
